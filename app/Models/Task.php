<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'lesson_id', 'student_id'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
