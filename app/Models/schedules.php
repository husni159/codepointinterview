<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    use HasFactory;
    
    protected $fillable = ['batch_id', 'url', 'course_id', 'start_date_time', 'end_date_time'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
