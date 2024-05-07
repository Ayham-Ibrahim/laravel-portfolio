<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'date',
        'description',
        'image',
        'link',
        'github-repo'
    ];



    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}

