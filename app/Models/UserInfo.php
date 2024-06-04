<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'birth_date',
        'country',
        'city',
        'address',
        'website',
        'email',
        'job_title',
        'first_image',
        'second_image',
        'cv'
    ];
}
