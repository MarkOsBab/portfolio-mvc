<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\PutRequest;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $tags = Tag::when($query, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
        ->orderByDesc('id')
        ->paginate(10);
        $title = 'Inicio | Dashboard';
        return view('dashboard.home', compact('tags', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Crear tag | Dashboard';
        return view('dashboard.tag.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try 
        {
            $tag = new Tag([
                'name' => strtoupper($request->validated('name'))
            ]);
            $tag->save();
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'No se pudo crear el servicio. Excepción: '.$e->getMessage());
        }
        return redirect('dashboard')->with('success', 'Tag creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        $title = 'Editar tag | Dashboard';
        return view('dashboard.tag.edit', compact('title', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, string $id)
    {
        try 
        {
            $tag = Tag::findOrFail($id);
            $tag->update([
                'name' => strtoupper($request->validated('name'))
            ]);

        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'No se pudo crear el servicio. Excepción: '.$e->getMessage());
        }
        return redirect('dashboard')->with('success', 'Tag actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tagName = $tag->name;
        $tag->delete();
        $status = "El tag '$tagName' ha sido eliminado.";
        return redirect()->route('dashboard')->with(compact('status'));
    }
}
