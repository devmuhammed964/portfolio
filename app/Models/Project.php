<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'description',
        'description_en',
        'image',
        'project_url',
        'github_url',
        'technologies',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
}
