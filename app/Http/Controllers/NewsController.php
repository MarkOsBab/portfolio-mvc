<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\PutRequest;
use App\Http\Requests\News\StoreRequest;
use App\Models\News;
use App\Models\NewsImage;
use App\Traits\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    use File;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $news = News::when($query, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        })
        ->orderByDesc('id')
        ->paginate(5);
        $title = 'News | Dashboard';
        return view('dashboard.news.index', compact('title', 'news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Crear noticia | Dashboard';
        return view('dashboard.news.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $news = News::create([
                'title' => $request->validated('title'),
                'slug' => $request->validated('slug'),
                'content' => $request->validated('content'),
                'visible' => $request->validated('visible'),
            ]);

            if($request->has('images'))
            {
                foreach ($request->file('images') as $image) {
                    $generatedName = $this->generateFileUniqueName(NewsImage::class, 'filename');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $generatedName.'.'.$extension;
                    $image_path = 'images/news';
                    Storage::putFileAs($image_path, $image, $filename, 'public');

                    $mime_type = $image->getMimeType();
                    $size = $image->getSize();

                    NewsImage::create([
                        'news_id' => $news->id,
                        'filename' => $filename,
                        'mime_type' => $mime_type,
                        'size' => $size
                    ]);
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Error al subir imágenes. Excepción: '.$e->getMessage());
        }

        return redirect('dashboard/news')->with('success', 'Noticia creada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        $title = 'Editar noticia | Dashboard';
        return view('dashboard.news.edit', compact('news', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, string $id)
    {
        try {
            $news = News::findOrFail($id);

            $news->update([
                'title' => $request->validated('title'),
                'slug' => $request->validated('slug'),
                'content' => $request->validated('content'),
                'visible' => $request->validated('visible'),
            ]);
            
            $deleted_images = $request->input('deleted_images', []);
            $existing_images = $news->images()->pluck('id')->toArray();

            $images_to_delete = array_intersect($deleted_images, $existing_images);
            $images_to_keep = array_diff($existing_images, $images_to_delete);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $generatedName = $this->generateFileUniqueName(NewsImage::class, 'filename');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $generatedName.'.'.$extension;
                    $image_path = 'images/news';
                    Storage::putFileAs($image_path, $image, $filename, 'public');
        
                    $mime_type = $image->getMimeType();
                    $size = $image->getSize();
        
                    NewsImage::create([
                        'news_id' => $news->id,
                        'filename' => $filename,
                        'mime_type' => $mime_type,
                        'size' => $size
                    ]);
                }
            }

            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $image_id) {
                    $image = NewsImage::findOrFail($image_id);
                    Storage::delete('images/news/'.$image->filename);
                    $image->delete();
                }
            }
        } catch(Exception $e) {
            return back()->with('error', 'Error al subir las imágenes. Excepción: '.$e->getMessage());
        }

        return redirect('dashboard/news')->with('success', 'Noticia actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $newsName = $news->name;

        foreach($news->images as $image)
        {
            $image = NewsImage::findOrFail($image->id);
            Storage::delete('images/news/'.$image->filename);
        }

        $news->delete();

        $status = "La noticia $newsName ha sido eliminado.";
        return redirect()->route('news.index')->with(compact('status'));
    }
}
