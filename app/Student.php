<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = 'student';

    protected $fillable = [
	    'name',
	    'dep',
	    'total_marks'
	];
}
