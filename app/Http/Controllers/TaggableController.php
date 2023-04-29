<?php

namespace App\Http\Controllers;

use App\Enums\TagType;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaggableController extends Controller
{
    public function create(string $taggableType, string $taggableId)
    {
        $taggableModel = '';
        switch($taggableType)
        {
            case TagType::NEWS_TYPE:
                $taggableModel = News::findOrFail($taggableId);
                break;
            case TagType::PROJECT_TYPE:
                $taggableModel = Project::findOrFail($taggableId);
                break;
            case TagType::SERVICE_TYPE:
                $taggableModel = Service::findOrFail($taggableId);
                break;
            default:
                abort(404);
                break;
        }
        if (!($taggableModel instanceof News || $taggableModel instanceof Project || $taggableModel instanceof Service)) {
            abort(404);
        }
        $tags = Tag::all();
        $assignedTagIds = $taggableModel->tags->pluck('id')->toArray();
        $title = 'Agregar etiquetas | Dashboard';
        return view('dashboard.taggable.create', compact('taggableModel', 'tags', 'title', 'taggableType', 'taggableId', 'assignedTagIds'));
    }

    public function store(Request $request, string $taggableType, string $taggableId)
    {
        $taggableModel = '';
        switch($taggableType)
        {
            case TagType::NEWS_TYPE:
                $taggableModel = News::findOrFail($taggableId);
                break;
            case TagType::PROJECT_TYPE:
                $taggableModel = Project::findOrFail($taggableId);
                break;
            case TagType::SERVICE_TYPE:
                $taggableModel = Service::findOrFail($taggableId);
                break;
            default:
                abort(404);
                break;
        }

        $tagIds = $request->tags;
        $currentTagIds = $taggableModel->tags->pluck('id')->toArray();

        // Agregar nuevas etiquetas
        foreach ($tagIds as $tagId) {
            if (!in_array($tagId, $currentTagIds)) {
                $taggableModel->tags()->attach($tagId, ['taggable_type' => $taggableType]);
            }
        }

        // Eliminar etiquetas no seleccionadas
        foreach ($currentTagIds as $tagId) {
            if (!in_array($tagId, $tagIds)) {
                $taggableModel->tags()->detach($tagId);
            }
        }

        return redirect('dashboard/' . $taggableType)->with('success', 'Etiquetas agregadas al ' . $taggableType . ' con éxito.');
    }

}
