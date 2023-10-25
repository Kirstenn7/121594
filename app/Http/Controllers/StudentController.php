<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }

    public function create(){
        return view('student.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            's_id' => 'required|numeric',
            'gender' => 'required|boolean',
            'age' => 'required|numeric',
            'absences' => 'required',
            'firstterm' => 'required',
            'secondterm' => 'required',
            'thirdterm' => 'required'
        ]);

        $newStudent = Student::create($data);

        return redirect(route('student.index'));
    }
}
