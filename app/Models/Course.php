<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = ['name', 'description', 'fee', 'max_student', 'total_duration_in_days'];

    // Define any relationships, accessors, mutators, or other methods as needed
    public function students()
    {
        return $this->belongsToMany(User::class, 'users')
            ->withTimestamps();
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

