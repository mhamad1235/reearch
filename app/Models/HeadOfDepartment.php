<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeadOfDepartment extends Model
{

    use HasFactory;
    protected $fillable = ['user_id', 'department_id'];

    /**
     * Get the department that the head belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the user for the head of department.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
