<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $table = 'projects_images';
    protected $fillable = [
        'project_id',
        'filename',
        'mime_type',
        'size',
    ];    

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
