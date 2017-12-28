<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
    protected $table = "lesson_comment";
    protected $primaryKey = "ID";
    public $timestamps = false;
}
