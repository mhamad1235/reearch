<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Absence extends Model
    {
        public $fillable=[
            'student_id',
            'teacher_id',
            'date'
        ];
        public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

}
