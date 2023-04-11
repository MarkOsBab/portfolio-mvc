<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\PutRequest;
use App\Http\Requests\Service\StoreRequest;
use App\Models\Service;
use App\Traits\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    use File;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $services = Service::when($query, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
        ->orderByDesc('id')
        ->paginate(5);
        $title = 'Servicios | Dashboard';
        return view('dashboard.service.index', compact('title', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Crear servicio | Dashboard';
        return view('dashboard.service.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $service = new Service();
            $service->name = $request->validated('name');
            $service->description = $request->validated('description');
            $service->visible = $request->validated('visible');
            $service->cost_range = $request->validated('cost_range');
            if($request->has('thumbnail'))
            {
                $generatedName = $this->generateFileUniqueName(Service::class, 'thumbnail');
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $filename = $generatedName.'.'.$extension;
                $image_path = 'images/services';
                Storage::putFileAs($image_path, $request->file('thumbnail'), $filename, 'public');
                $service->thumbnail = $filename;
            }
            $service->save();
        } catch(Exception $e) {
            return back()->with('error', 'No se pudo crear el servicio. Excepción: '.$e->getMessage());
        }
        return redirect('dashboard/services')->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $title = 'Editar servicio | Dashboard';
        return view('dashboard.service.edit', compact('title', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->name = $request->validated('name');
            $service->description = $request->validated('description');
            $service->visible = $request->validated('visible');
            $service->cost_range = $request->validated('cost_range');
            if($request->has('thumbnail'))
            {
                if($service->thumbnail != null)
                {
                    Storage::delete('images/services/'.$service->thumbnail);
                }
                $generatedName = $this->generateFileUniqueName(Service::class, 'thumbnail');
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $filename = $generatedName.'.'.$extension;
                $image_path = 'images/services';
                Storage::putFileAs($image_path, $request->file('thumbnail'), $filename, 'public');
                $service->thumbnail = $filename;
            }
            $service->save();
        } catch(Exception $e) {
            return back()->with('error', 'No se pudo actualizar el servicio. Excepción: '.$e->getMessage());
        }
        return redirect('dashboard/services')->with('success', 'Servicio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $serviceName = $service->name;
        Storage::delete('images/services/'.$service->thumbnail);
        $service->delete();

        $status = "El servicio $serviceName ha sido eliminado.";

        return redirect('dashboard/services')->with(compact('status'));
    }
}
