<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';

    protected $fillable = [
        's_id',
        'gender',
        'age',
        'absences',
        'firstterm',
        'secondterm',
        'thirdterm'
    ];
}
