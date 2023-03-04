<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::select('name','course','email','phone')->get();
        return response()->json([
            'status' => 200,
            'students' =>$students,
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|max:191',
            'course' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|min:10|max:191',
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'message'=>$validator->message()
            ], 422);
        }
        else{
            $student = new Student;
            $student->name = $request->name;
            $student->course = $request->course;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            return response()->json([
                'status'=>200,
                'message'=>'Student create successfully'
            ],200);
        }
    }

    public function show($id)
    {
        $students = Student::find($id);

        if($students){
        return response()->json([
            'status'=>200,
            'student'=>$students
        ]);
    }
    else{
        return response()->json([
            'status'=>404,
            'student'=>'Id Not Found'
        ],404);
    }
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if($student)
        {
            $student->name = $request->name;
            $student->course = $request->course;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->update();

            return response()->json([
                'status'=>200,
                'message'=>'Student Updated successfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'student'=>'Id Not Found'
            ],404);
        }
    }
    public function delete($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted successfully'
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'student'=>'Id Not Found'
            ],404);
        }
    }
}
