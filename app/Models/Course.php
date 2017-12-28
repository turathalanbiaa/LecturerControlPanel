<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "course";
    protected $primaryKey = "ID";
    public $timestamps = false;

    public function Lessons()
    {
        return $this->hasMany('App\Models\Lesson', 'Course_ID', 'ID')->orderBy("ID");
    }
}
