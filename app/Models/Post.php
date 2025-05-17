<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Post extends Model
{
        protected $fillable = [
        'image',
        'name_en',
        'name_ku',
        'description_en',
        'description_ku',
    ];

}
