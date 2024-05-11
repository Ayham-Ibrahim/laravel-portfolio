<?php

namespace App\Models;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'avarage',
    ];



    public function projects()
    {
        return $this->belongsToMany(Project::class,'project_skill');
    }
}

