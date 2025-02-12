<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function tasks(){
        return $this->hasOne(Task::class, 'lesson_id', 'id');
    }
}
