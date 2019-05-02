<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;

class StudentController extends Controller
{
    public function addStudent(Request $request) {
    	$student  = new Student();
    	$student->name = $request->name;
    	$student->dep = $request->dep;
    	$student->total_marks = $request->total_marks;

    	$student->save();

   		return response()->json(['success' => 'Student added successfully.']);
    }
    public function studentList(Request $request){
        $students = Student::paginate(2);
        // if ($request->ajax()) {
        //     return view('sresult', compact('students'));
        // }
        return view('student',compact('students'));
    }
    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $students = Student::paginate(2);
            return view('student', compact('students'))->render();
        }
    }
}
    