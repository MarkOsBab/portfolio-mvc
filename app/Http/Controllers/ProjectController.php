<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\PutRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Traits\File;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use File;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(5);
        $title = 'Proyectos | Dashboard';
        return view('dashboard.project.index', compact('projects', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Crear | Dashboard';
        return view('dashboard.project.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreRequest $request)
    {
        try {
            $project = Project::create([
                'name' => $request->validated('name'),
                'description' => $request->validated('description'),
                'start_date' => $request->validated('start_date'),
                'end_date' => $request->validated('end_date'),
                'link' => $request->validated('link')
            ]);

            if($request->has('images'))
            {
                foreach ($request->file('images') as $image) {
                    $generatedName = $this->generateFileUniqueName(ProjectImage::class, 'filename');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $generatedName.'.'.$extension;
                    $image_path = 'images/projects';
                    Storage::putFileAs($image_path, $image, $filename, 'public');

                    $mime_type = $image->getMimeType();
                    $size = $image->getSize();

                    ProjectImage::create([
                        'project_id' => $project->id,
                        'filename' => $filename,
                        'mime_type' => $mime_type,
                        'size' => $size
                    ]);
                }
            }
        } catch (Exception $e) {
            return back()->with('error', 'Error al subir imágenes. Excepción: '.$e->getMessage());
        }

        return redirect('dashboard/projects')->with('success', 'Proyecto creado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Editar | Dashboard';
        $project = Project::findOrFail($id);
        return view('dashboard.project.edit', compact('title', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, string $id)
    {
        try {
            $project = Project::findOrFail($id);

            $project->update([
                'name' => $request->validated('name'),
                'description' => $request->validated('description'),
                'start_date' => $request->validated('start_date'),
                'end_date' => $request->validated('end_date'),
                'link' => $request->validated('link')
            ]);
            
            $deleted_images = $request->input('deleted_images', []);
            $existing_images = $project->images()->pluck('id')->toArray();

            $images_to_delete = array_intersect($deleted_images, $existing_images);
            $images_to_keep = array_diff($existing_images, $images_to_delete);

            foreach ($images_to_delete as $image_id) {
                $image = ProjectImage::find($image_id);
                Storage::delete('images/projects/' . $image->filename);
                $image->delete();
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $generatedName = $this->generateFileUniqueName(ProjectImage::class, 'filename');
                    $extension = $image->getClientOriginalExtension();
                    $filename = $generatedName.'.'.$extension;
                    $image_path = 'images/projects';
                    Storage::putFileAs($image_path, $image, $filename, 'public');
        
                    $mime_type = $image->getMimeType();
                    $size = $image->getSize();
        
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'filename' => $filename,
                        'mime_type' => $mime_type,
                        'size' => $size
                    ]);
                }
            }

            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $image_id) {
                    $image = ProjectImage::findOrFail($image_id);
                    Storage::delete('images/projects/'.$image->filename);
                    $image->delete();
                }
            }
        } catch(Exception $e) {
            return back()->with('error', 'Error al subir las imágenes. Excepción: '.$e->getMessage());
        }

        return redirect('dashboard/projects')->with('success', 'Proyecto actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $projectName = $project->name;
        $project->delete();

        $status = "El proyecto $projectName ha sido eliminado.";

        return redirect()->route('projects.index')->with(compact('status'));
    }
}
