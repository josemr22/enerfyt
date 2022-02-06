<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function index()
    {
        //
        $services = Service::orderByDesc('created_at')->get();
        return view('admin.service.index', compact('services'));
    }

    public function create()
    {
        //
        return view('admin.service.create', [
            'service' => new Service(),
        ]);
    }

    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'El campo Título es obligatorio',
            'content.required' => 'El campo Contenido es obligatorio',
            'image.required' => 'El campo Imagen es obligatorio',
        ]);
        $path = public_path() . '/img/services';
        if ($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $image = \Image::make($file);
            $image->fit(400, 290)->save($path.'/'.$fileName);
            service::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $fileName]);
        }
        return redirect()->route('services.index')->with('success', 'Registro Exitoso');
    }

    public function edit(Service $service)
    {
        //
        return view('admin.service.edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        //
        $oldFileName = $service->image;
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'El campo Título es obligatorio',
            'content.required' => 'El campo Contenido es obligatorio',
        ]);
        $path = public_path() . '/images/services';
        $fileName = null;
        if ($file = $request->file('image')) {
            $fileName = time() . $file->getClientOriginalName();
            $image = \Image::make($file);
            $image->fit(400, 290)->save($path.'/'.$fileName);
        }
        $service->fill([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        if ($fileName != null) {
            $service->image = $fileName;
            try {
                unlink($path . '/' . $oldFileName);
            } catch (\Exception $e) {

            }
        }
        $service->save();
        return redirect()->route('services.index')->with('success', 'Registro Actualizado');
    }

    public function destroy(Service $service)
    {
        //
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Registro Eliminado');
    }
}
