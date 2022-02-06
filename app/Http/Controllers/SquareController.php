<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Square;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SquareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.square.index');
    }

    public function table()
    {
        return datatables()
            ->eloquent(Square::orderByDesc('created_at'))
            ->addColumn('actions','admin.square._actions')
            ->rawColumns(['actions'])
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); return $formatedDate; })
            ->toJson();
    }

    public function report(Request $request)
    {
        //
        $date=$request->date;
        $type=$request->type;
        $title="";
        if ($type=="in") {
            $title="Reporte de Ingresos";
        }elseif ($type=="out") {
            $title="Reporte de Salidas";
        }
        $title.=" | ".$date;
        $squares = Square::where("type",$type)->whereDate('created_at', '=', date($date))->get();
        $products=array();
        foreach ($squares as $square) {
            foreach ($square->products as $product) {
                array_push($products,$product);
            }
        }
        return view('admin.square.report',compact('products','title','type','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.square.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type'=>['required'],
            'commentary'=>['nullable'],
        ]);
        try{
        $error=DB::transaction(function () use($data,$request) {
            $square=Square::create([
                'type'=>$data['type'],
                'commentary'=>$data['commentary'],
            ]);
            foreach ($request->products as $value) {
                $product=Product::findOrFail($value['id']);
                if($data['type']=='in'){
                    $product->stock=$product->stock+$value['stock'];
                }else{
                    if($product->stock-$value['stock']>=0){
                        $product->stock=$product->stock-$value['stock'];
                    }else{
                        throw new Exception();
                    }
                }
                $product->save();
                $square->products()->attach($product,[
                    'quantity'=>$value['stock'],
                ]);
            }
        });
        }catch(Exception $e){
            return response()->json(["errors"=>["e"=>["No puede tener un stock negativo"]]],422);
        }
        if($error==null){
            return response()->json(201);
        }else{
            return $error;
            //return response()->json("F");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Square  $square
     * @return \Illuminate\Http\Response
     */
    public function show(Square $square)
    {
        //
        $type = $square->type;
        $products=$square->products;
        return view('admin.square.show',compact('products','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Square  $square
     * @return \Illuminate\Http\Response
     */
    public function edit(Square $square)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Square  $square
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Square $square)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Square  $square
     * @return \Illuminate\Http\Response
     */
    public function destroy(Square $square)
    {
        //
    }

    public function templateTable(Request $request){
        $data=$request->validate([
            'id'=>['required',Rule::exists('products', 'id')->whereNull('deleted_at')],
        ]);
        $product=Product::find($data['id']);
        $stock=$product->stock;
        $template='';
        foreach ($stock as $row){
            $color=Color::findOrFail($row->color_id);
            $size=Size::findOrFail($row->size_id);
            $template=$template."
                        <tr onclick=\"rowClick('$product->id','$row->quantity','$product->code','$product->name','$size->name','$color->name','$size->id','$color->id')\">
                            <th scope=\"row\">$row->quantity</th>
                            <td>$product->code</td>
                            <td>$product->name</td>
                            <td>$size->name</td>
                            <td>$color->name</td>
                        </tr>";
        }
        return $template;
    }
}
