<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'link',
    ];

    public function images() 
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }
}
