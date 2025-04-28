<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
        // Define the fillable fields
        protected $fillable = ['name'];

        // Optionally, define timestamps if not using Laravel's default
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';
    
        /**
         * Get the courses for the department.
         */
   
}
