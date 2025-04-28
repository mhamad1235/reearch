<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
   protected $fillable = ['name', 'teacher_id', 'pdf_path'];
    public $timestamps = false;
    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

}
