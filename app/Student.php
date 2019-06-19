<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table 		=	'student';
	protected $primaryKey	=	'student_id';
    protected $fillable 	= 	[
							        'student_name', 'student_phone', 'student_email', 'student_address', 'file_path'
							    ];
}
