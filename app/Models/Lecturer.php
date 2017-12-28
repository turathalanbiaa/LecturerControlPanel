<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = "lecturer";
    protected $primaryKey = "ID";
    public $timestamps = false;


    public function Courses()
    {
        return $this->hasMany('App\Models\Course', 'Lecturer_ID','ID')->orderBy("ID");
    }
}
