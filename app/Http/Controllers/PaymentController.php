<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Item;
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


class PaymentController extends Controller
{
    //
    public function payment(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'telephone' => ['required','integer'],
            'address' => ['required'],
            'reference' => ['nullable'],
            'mail' => ['required','email'],
            'detail' => ['nullable'],
            'selectShippingMethod' => ['required',Rule::in([0,1])],
            'selectDestination' => ['nullable',Rule::exists('destinations', 'id')],
            'selectPurchaseMethod' => ['required',Rule::in(PayMode::getList())],
            'transactionAmount' => ['required'],
        ],[
            'name.required'=>'El campo Nombre es obligatorio',
            'telephone.required'=>'El campo Teléfono es obligatorio',
            'telephone.integer'=>'El valor ingresado en el campo Teléfono no es válido',
            'address.required'=>'El campo Dirección es obligatorio',
            'mail.required'=>'El campo Correo es obligatorio',
            'mail.email'=>'Debes ingresar un e-mail válido',
            'selectShippingMethod.required'=>'Selecciona un método de envío',
            'selectDestination.exists'=>'Destino no válido',
            'selectPurchaseMethod.required'=>'Selecciona un método de pago',
            'selectPurchaseMethod.in'=>'Método de Pago no válido',
            'transactionAmount.required'=>'Ocurrió un error',
        ]);

        if($data['selectShippingMethod']==0){
            $tariff=0;
        }else{
            $destination = Destination::findOrFail($data['selectDestination']);
            $tariff=$destination->tariff;
        }
        $amount=$tariff+Cart::priceTotal();
        if($data['transactionAmount']==$amount){
            if($data['selectPurchaseMethod']=="Depósito"){
                return $this->generateOrder($data);
            }else{
                $paymentPlatform = resolve(MercadoPagoService::class);
                $pago=$paymentPlatform->handlePayment($request);
                if($pago==="approved"){
                    return $this->generateOrder($data);
                }else{
                    return redirect(route('incorrect-deposit'));
                }
            }
        }else{
            return redirect()->back()->withErrors(['distincts'=>'Tu carrito no está actualizado. Te recomendamos actualizar la página']);
        }
//        [▼
//          "name" => "Jose Luis"
//          "telephone" => "989898989"
//          "address" => "av cesar vallejo"
//          "reference" => "asdas"
//          "mail" => "asddasd@outlook.com"
//          "detail" => null
//          "selectShippingMethod" => "1"
//          "selectDestination" => "17"
//          "selectPurchaseMethod" => "Depósito"
//        ]
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function generateOrder(array $data)
    {
        try {
            $transaction = DB::transaction(function () use ($data) {
                //-------------------Order Create------------------------
                $order = new Order();
                $order->name = $data['name'];
                $order->telephone = $data['telephone'];
                $order->mail = $data['mail'];
                $order->address = $data['address'];
                $order->reference = $data['reference'];
                $order->detail = $data['detail'];
                $order->delivery = $data['selectShippingMethod'] == '0' ? false : true;
                if ($order->delivery) {
                    $destination = Destination::findOrFail($data['selectDestination']);
                    $order->destination = $destination->name;
                    $order->tariff = $destination->tariff;
                } else {
                    $order->destination = null;
                    $order->tariff = null;
                }
                $order->paymode = $data['selectPurchaseMethod'];
                if ($order->paymode == "Mercado Pago") {
                    $order->state = "Aceptado";
                    $order->acepted_at = Carbon::now()->format('Y-m-d H:i:s');
                } elseif ($order->paymode == "Depósito") {
                    $order->state = "Espera";
                }
                $total = 0;
                $order->total = $total;
                $order->save();
                //---------------------ITEMS------------------------------
                $cart = Cart::content();
                foreach ($cart as $unit) {
                    $product = Product::findOrFail($unit->id);
                    $order->items()->attach($unit->id, [
                        'color_id' => $unit->options->color->id,
                        'size_id' => $unit->options->size->id,
                        'quantity' => $unit->qty,
                        'saleprice' => $product->price,
                    ]);
                    //Comprobar stock
//                $stock = Stock::where('product_id', '=', $unit->producto_id)->where('size_id', '=', $unit->talla_id)->where('color_id', '=', $unit->color_id)->first();
//                if ($stock->quantity >= $unit->cantidad) {
//                    $stock->quantity = $stock->quantity - $unit->cantidad;
//                } else {
//                    $dat[0] = array("respuesta" => "ERROR", "msg" => "STOCK NEGATIVO: " . $stock->product->name);
//                    throw new \Exception(json_encode($dat));
//                }
//                $stock->save();
                    $total = $total + ($product->price * floatval($unit->qty));
                }
                //-----------------------------------------------------
                if ($order->tariff != null) {
                    $order->total = $total + $order->tariff;
                } else {
                    $order->total = $total + $order->tariff;
                }
                $order->save();
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
                return redirect(route('correct-deposit'));
            } else {
                return redirect(route('incorrect-deposit'));
            }
        } catch (\Exception $e) {
            return redirect(route('incorrect-deposit'))->withErrors(['error' => " " . $e->getMessage()]);
        }
    }
}
