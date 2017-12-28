<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lesson";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function Comments()
    {
        return $this->hasMany('App\Models\LessonComment', 'Lesson_ID', 'ID');
    }
}
