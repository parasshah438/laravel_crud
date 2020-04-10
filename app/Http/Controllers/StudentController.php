<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Hash;

class StudentController extends Controller
{
    
    public function index()
    {

        $data = Student::latest()->paginate(2);
        return view('student.index',compact('data'));
    }

   
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = new Student;
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = Hash::make($request->input('password'));
        $data->mobile = $request->input('mobile');
        
        $image = $request->file('image');
        if($image)
        {
            $image_name = time(). '.' .$image->getClientOriginalName();
            $path = public_path('/student_profile');
            $image->move($path,$image_name);
            $data->image = $image_name;
        }
        $data->save();

       return redirect()->route('student.index')->with('success','Student is successfully inserted');
    }

    public function show($id)
    {
        $data = Student::findOrFail($id);
        return view('student.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $data = Student::findOrFail($student->id);
        return view('student.edit',compact('data'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        
        $data = Student::findOrFail($student->id);
        $image = $request->file('image');
        if($image)
        {
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->mobile = $request->input('mobile');
            if($password = $request->input('password'))
            {
                $data->password = Hash::make($password);
            }
            $image_name = time(). '.' .$image->getClientOriginalName();
            $path = public_path('/student_profile');
            $image->move($path,$image_name);
            $data->image = $image_name;  
        }
        else
        {
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->mobile = $request->input('mobile');
            if($password = $request->input('password'))
            {
                $data->password = Hash::make($password);
            }
        }    
        $data->save();
        return redirect()->route('student.index')->with('success','Student is successfully updated');
    }

    public function destroy(Student $student)
    {
        Student::findOrFail($student->id)->delete();
        return redirect('student');
    }
}
