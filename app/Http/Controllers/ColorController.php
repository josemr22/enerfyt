<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.color.index');
    }

    public function table()
    {
        return datatables()
            ->eloquent(Color::query())
            ->addColumn('preview','<div class="border border-dark" style="background:{{$code}};margin: auto;width: 100%;height: 25px"></div>')
            ->addColumn('actions','admin.color._actions')
            ->rawColumns(['actions','preview'])
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
        $color=new Color;
        return view('admin.color.create', compact('color'));
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
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'code.required' => 'Debe ingresar un código de color',
        ]);

        Color::create(['name'=>$data['name'],'code'=>$data['code']]);

        return json_encode(array("r"=>"OK"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        //
        return view('admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'code.required' => 'Debe ingresar un código de color',
        ]);

        $color->fill([
            'name' => $data['name'],
            'code' => $data['code'],
        ]);
        $color->save();
        return json_encode(array("r"=>"OK"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
        $color->delete();

        return json_encode(array("r"=>"OK"));
    }
}
