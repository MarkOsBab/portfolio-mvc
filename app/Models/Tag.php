<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'name'
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'taggable', 'tag_id', 'taggable_id')
                    ->where('taggable_type', 'project');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'taggable', 'tag_id', 'taggable_id')
                    ->where('taggable_type', 'news');
    }

    public function service()
    {
        return $this->belongsToMany(Service::class, 'taggable', 'tag_id', 'taggable_id')
            ->where('taggable_type', 'service');
    }
}
