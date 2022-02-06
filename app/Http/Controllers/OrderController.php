<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Order;
use App\Models\PayMode;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Services\MercadoPagoService;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.order.index');
    }

    public function table()
    {
        return datatables()
            ->eloquent(Order::query()
                ->where('state','!=','rejected')
                ->where('state','!=','init')
                ->select('orders.*'))
            ->addColumn('actions','admin.order._actions')
            ->rawColumns(['actions'])
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
            ->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        return view('admin.order.show',compact('order'));
    }

    public function changeState(Order $order)
    {
        //
        if($order->state=='in_process'){
            $order->update([
                'state'=>'accepted',
                'accepted_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }else{
            $order->update([
                'state'=>'delivered',
                'delivered_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        return response()->json();
    }

    public function reject(Order $order)
    {
        //
        if(!$order->state=='delivered'){
            foreach ($order->products as $unit) {
                $product = Product::findOrFail($unit->id);
                $product->stock = $product->stock + $unit->id;
                $product->save();
            }
        }
        $order->update([
            'state'=>'rejected',
            'rejected_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function payment(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['required','integer'],
            'address' => ['required'],
            'reference' => ['nullable'],
            'email' => ['required','email'],
            'detail' => ['nullable'],
            'delivery' => ['required',Rule::in([0,1])],
            'place' => ['nullable',Rule::exists('destinations', 'id')],
            'payMethod' => ['required',Rule::in(['card','deposit'])],
            'docType' => ['required'],
            'docNumber' => ['required'],
            'transactionAmount' => ['required'],
            'paymentMethodId' => ['required'],
            'token' => ['required'],
        ],[
            'name.required'=>'El campo Nombre es obligatorio',
            'phone.required'=>'El campo Teléfono es obligatorio',
            'phone.integer'=>'El valor ingresado en el campo Teléfono no es válido',
            'address.required'=>'El campo Dirección es obligatorio',
            'email.required'=>'El campo Correo es obligatorio',
            'email.email'=>'Debes ingresar un correo válido',
            'delivery.required'=>'Selecciona un método de envío',
            'delivery.in'=>'Método de envío no válido',
            'place.exists'=>'Destino no válido',
            'payMethod.required'=>'Selecciona un método de pago',
            'docType.required'=>'Selecciona un tipo de documento',
            'docNumber.required'=>'Ingresa número de documento',
            'transactionAmount.required'=>'Ocurrió un error',
            'paymentMethodId.required'=>'Ocurrió un error',
            'token.required'=>'Información de pago inválida',
        ]);

        if(count(Cart::content())<=0){
            return back()->withErrors(['error' => "Tu Carrito está vacío"]);
        }

        if($data['delivery']==0){
            $tariff=0;
        }else{
            $destination = Destination::findOrFail($data['place']);
            $tariff=$destination->tariff;
        }
        $amount=$tariff+Cart::priceTotal();
        if(floatval($data['transactionAmount'])==$amount){

            try {
                $transaction = DB::transaction(function () use ($data,$request) {
                    //-------------------Order Create------------------------
                    $order = new Order();
                    $order->name = $data['name'];
                    $order->phone = $data['phone'];
                    $order->email = $data['email'];
                    $order->address = $data['address'];
                    $order->doc_type = $data['docType'];
                    $order->doc_number = $data['docNumber'];
                    $order->reference = $data['reference'];
                    $order->detail = $data['detail'];
                    $order->delivery = $data['delivery'] == '1' ? true : false;
                    if ($order->delivery) {
                        $destination = Destination::findOrFail($data['place']);
                        $order->destination_id = $destination->id;
                        $order->tariff = $destination->tariff;
                    } else {
                        $order->destination_id = null;
                        $order->tariff = null;
                    }
                    $order->pay_method = $data['payMethod'];
                    $order->payment_method_id = $data['paymentMethodId'];
                    $order->state = "init";
                    // $order->accepted_at = Carbon::now()->format('Y-m-d H:i:s');
                    // $total = 0;
                    if ($order->tariff != null) {
                        $order->total = Cart::priceTotal() + $order->tariff;
                    } else {
                        $order->total = Cart::priceTotal();
                    }
                    $order->save();
                    //---------------------ITEMS------------------------------
                    $cart = Cart::content();
                    foreach ($cart as $unit) {
                        $product = Product::findOrFail($unit->id);

                        //Comprobar stock
                        if ($product->stock >= $unit->qty) {
                            $product->stock = $product->stock - $unit->qty;
                        } else {
                            // $dat[0] = array("respuesta" => "ERROR", "msg" => "STOCK NEGATIVO: " . $product->stock);
                            throw new \Exception("error-stock");
                        }
                        $product->save();

                        $order->items()->attach($product->id, [
                            'quantity' => $unit->qty,
                            'saleprice' => $product->price,
                        ]);

                        // $total = $total + ($product->price * $unit->qty);
                    }
                    //-----------------------------------------------------
                    // if ($order->tariff != null) {
                    //     $order->total = $total + $order->tariff;
                    // } else {
                    //     $order->total = $total + $order->tariff;
                    // }
                    // return new \App\Mail\Contact($data);
    //                if ($order->paymode == "Depósito") {
    //                    $cart=Cart::content();
    //                    $finalTotal = $data['transactionAmount'];
    //                    Mail::to($data['mail'])->send(new \App\Mail\Deposit($cart,$finalTotal));
    //                }else{
    //                    $cart=Cart::content();
    //                    $finalTotal = $data['transactionAmount'];
    //                    Mail::to($data['mail'])->send(new \App\Mail\Deposit($cart,$finalTotal));
    //                }

                    $paymentPlatform = resolve(MercadoPagoService::class);
                    $payment=$paymentPlatform->handlePayment($request);
                    if($payment->status==="approved"){
                        $order->state="approved";
                        $order->accepted_at=Carbon::now()->format('Y-m-d H:i:s');
                        $order->save();
                        return redirect(route("successful-order"));
                    }elseif($payment->status==="in_process"){
                        $order->state="in_process";
                        $order->save();
                        return redirect(route('in-process-order'));
                    }else{
                        $order->state="rejected";
                        $order->rejected_at=Carbon::now()->format('Y-m-d H:i:s');

                        //Reestablecer stock
                        $cart = Cart::content();
                        foreach ($cart as $unit) {
                            $product = Product::findOrFail($unit->id);
                            $product->stock = $product->stock + $unit->qty;
                            $product->save();
                        }

                        $order->save();
                        return redirect(route('failed-order'));
                    }
                });
            } catch (\Exception $e) {
                $e->getMessage() == 'error-stock' ? $errorMessage="El stock ha sido actualizado y ya no podemos atender a este pedido" : $errorMessage=$e->getMessage();
                return back()->withErrors(['error' => " " . $errorMessage]);
            }

            // $paymentPlatform = resolve(MercadoPagoService::class);
            // $payment=$paymentPlatform->handlePayment($request);
            // if($payment->status==="approved"){
            //     $order=Order::find($data['place']);
            //     $order->state="approved";
            //     $order->accepted_at=Carbon::now()->format('Y-m-d H:i:s');
            //     return redirect(route("successful-order"));
            // }elseif($payment->status==="in_process"){
            //     $order->state="in_process";
            //     return redirect(route('in-process-order'));
            // }else{
            //     $order->state="rejected";
            //     $order->rejected_at=Carbon::now()->format('Y-m-d H:i:s');
            //     return redirect(route('failed-order'));
            // }
            return $transaction;
        }else{
            return redirect()->back()->withErrors(['distincts'=>'Tu carrito no está actualizado. Te recomendamos actualizar la página']);
        }
    }

    public function deposit(Request $request){
        $data=$request->all();

        if($data['delivery']==0){
            $tariff=0;
        }else{
            $destination = Destination::findOrFail($data['place']);
            $tariff=$destination->tariff;
        }
        $amount = $tariff + Cart::priceTotal();
        if(floatval($data['transactionAmount'])==$amount){
            try {
                DB::transaction(function () use ($data) {
                    //-------------------Order Create------------------------
                    $order = new Order();
                    $order->name = $data['name'];
                    $order->phone = $data['phone'];
                    $order->email = $data['email'];
                    $order->address = $data['address'];
                    $order->reference = $data['reference'];
                    $order->detail = $data['detail'];
                    $order->delivery = $data['delivery'] == '1' ? true : false;
                    if ($order->delivery) {
                        $destination = Destination::findOrFail($data['place']);
                        $order->destination_id = $destination->id;
                        $order->tariff = $destination->tariff;
                    } else {
                        $order->destination_id = null;
                        $order->tariff = null;
                    }
                    $order->pay_method = 'deposit';
                    $order->state = "in_process";
                    if ($order->tariff != null) {
                        $order->total = Cart::priceTotal() + $order->tariff;
                    } else {
                        $order->total = Cart::priceTotal();
                    }
                    $order->save();
                    //---------------------ITEMS------------------------------
                    $cart = Cart::content();
                    foreach ($cart as $unit) {
                        $product = Product::findOrFail($unit->id);

                        //Comprobar stock
                        if ($product->stock >= $unit->qty) {
                            $product->stock = $product->stock - $unit->qty;
                        } else {
                            throw new Exception("error-stock");
                        }
                        $product->save();

                        $order->items()->attach($product->id, [
                            'quantity' => $unit->qty,
                            'saleprice' => $product->price,
                        ]);
                    }
                });
                Cart::destroy();
                return response()->json(['msg'=>'ok']);
            } catch (\Exception $e) {
                $e->getMessage() == 'error-stock' ? $errorMessage="El stock ha sido actualizado y ya no podemos atender a este pedido" : $errorMessage=$e->getMessage();
                return response()->json(['msg' =>$errorMessage]);
            }
        }
        return response()->json(['msg'=>'Ha ocurrido un error. Actualiza la página e inténtalo de nuevo.']);
    }

    public function successfulOrder(){
        $categories=Category::all();
        return view('page.order.successful-order',compact('categories'));
    }

    public function inProcessOrder(){
        Cart::destroy();
        $categories=Category::all();
        return view('page.order.in-process-order',compact('categories'));
    }

    public function failedOrder(){
        $categories=Category::all();
        return view('page.order.failed-order',compact('categories'));
    }

    protected function generateOrder(array $data)
    {
        try {
            $transaction = DB::transaction(function () use ($data) {
                //-------------------Order Create------------------------
                $order = new Order();
                $order->name = $data['name'];
                $order->phone = $data['phone'];
                $order->email = $data['email'];
                $order->address = $data['address'];
                $order->reference = $data['reference'];
                $order->detail = $data['detail'];
                $order->delivery = $data['delivery'] == '1' ? true : false;
                if ($order->delivery) {
                    $destination = Destination::findOrFail($data['place']);
                    $order->destination_id = $destination->id;
                    $order->tariff = $destination->tariff;
                } else {
                    $order->destination_id = null;
                    $order->tariff = null;
                }
                $order->pay_method = $data['payMethod'];
                $order->payment_method_id = $data['paymentMethodId'];
                if ($order->pay_method == "card") {
                    $order->state = "Aceptado";
                    $order->accepted_at = Carbon::now()->format('Y-m-d H:i:s');
                } else{
                    $order->state = "in_process";
                }
                // $total = 0;
                if ($order->tariff != null) {
                    $order->total = Cart::priceTotal() + $order->tariff;
                } else {
                    $order->total = Cart::priceTotal();
                }
                $order->save();
                //---------------------ITEMS------------------------------
                $cart = Cart::content();
                foreach ($cart as $unit) {
                    $product = Product::findOrFail($unit->id);

                    //Comprobar stock
                    if ($product->stock >= $unit->qty) {
                        $product->stock = $product->stock - $unit->qty;
                    } else {
                        // $dat[0] = array("respuesta" => "ERROR", "msg" => "STOCK NEGATIVO: " . $product->stock);
                        throw new \Exception();
                    }
                    $product->save();

                    $order->items()->attach($product->id, [
                        'quantity' => $unit->qty,
                        'saleprice' => $product->price,
                    ]);

                    // $total = $total + ($product->price * $unit->qty);
                }
                //-----------------------------------------------------
                // if ($order->tariff != null) {
                //     $order->total = $total + $order->tariff;
                // } else {
                //     $order->total = $total + $order->tariff;
                // }
                //return new \App\Mail\Contact($data);
//                if ($order->paymode == "Depósito") {
//                    $cart=Cart::content();
//                    $finalTotal = $data['transactionAmount'];
//                    Mail::to($data['mail'])->send(new \App\Mail\Deposit($cart,$finalTotal));
//                }else{
//                    $cart=Cart::content();
//                    $finalTotal = $data['transactionAmount'];
//                    Mail::to($data['mail'])->send(new \App\Mail\Deposit($cart,$finalTotal));
//                }
            });
            if ($transaction == null) {
                return redirect(route('successful-order'));
            }else{
                return $transaction;
                return redirect(route('failed-order'));
            }
        } catch (\Exception $e) {
            return redirect(route('failed-order'))->withErrors(['error' => " " . $e->getMessage()]);
        }
    }
}
