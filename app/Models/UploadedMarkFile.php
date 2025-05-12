<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedMarkFile extends Model
{
    protected $fillable = [
        'teacher_id',
        'original_name',
        'file_name',
        'file_path',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
