<?php

namespace App\Models;
use App\Models\Skill;
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
        'link',
        'github_repo',
        'image',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'project_skill');
    }
}

