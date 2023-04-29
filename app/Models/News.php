<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'visible'
    ];

    public function images()
    {
        return $this->hasMany(NewsImage::class, 'news_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggable', 'taggable_id', 'tag_id')
                    ->where('taggable_type', 'news');
    }
}
