<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'visible',
        'thumbnail',
        'cost_range'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggable', 'taggable_id', 'tag_id')
                    ->where('taggable_type', 'services');
    }
}
