<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'department_id',
        'password',
        'assigned_classes',
        'class'
    ];
    protected $casts = [
        'assigned_classes' => 'array',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
{
    return $this->hasMany(Course::class, 'teacher_id');
}
  // Absences where this user is a student
  public function absencesAsStudent()
  {
      return $this->hasMany(Absence::class, 'student_id');
  }

  // Absences where this user is a teacher
  public function absencesAsTeacher()
  {
      return $this->hasMany(Absence::class, 'teacher_id');
  }

}
