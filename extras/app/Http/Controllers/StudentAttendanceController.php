<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use Illuminate\Support\Facades\Input;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     use FormBuilderTrait;
     public function __construct(){
       $this->middleware('role:admin',['except'=>['index','show','create','store']]);
     }

    public function index(\App\Student $student)
    {
        //
        return view('admins.students.attendance.index')->with('student',$student);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Student $student)
    {
        $form = $this->form(\App\Forms\AttendanceForm::class, [
          'method' => 'POST',
          'route' => array('students.attendance.store',\Auth::user()->roles()->first()->name,$student->_id),
      ]);

        return view('admins.students.attendance.create',compact('form','student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Student $student)
    {
        //

        $form=$this->form(\App\Forms\AttendanceForm::class);

        $form->validate(['student_id'=>'required|unique:mongodb.students,student_id']);
        $form->validate(['type'=>'required']);
        $form->validate(['slot'=>'required']);
        $form->validate(['attendance_on' => 'date_format:"d/m/Y"|required']);

        echo Input::get('attendance_on');

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $collection=$student->attendances()->where('attendance_on',Input::get('attendance_on'))
        ->where('type',Input::get('type'))
        ->where('slot', Input::get('slot'))
        ->first();
       if(empty($collection))
       {
         echo "no duplicate entry found";
          $attendance=new \App\Attendance;
          $attendance->type=Input::get('type');
          $attendance->slot=Input::get('slot');
          $attendance->attendance_on=Input::get('attendance_on');
          $attendance->marked_by=\Auth::user()->name;
          $attendance->creator_id=\Auth::user()->id;
          $student->attendances()->save($attendance);
          return redirect()->route('students.attendance.index',[\Auth::user()->roles()->first()->name,$student->_id])
          ->withSuccess("successfully added student attendance details");
       }

       else{

        return redirect()->back()->withErrors('An Attendance Record With Same Combination Found')->withInput();

       }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Student $student ,$id)
    {
        //
        $attendance=$student->attendances()->find($id);

        return view('admins.students.attendance.show')
        ->with('attendance',$attendance)
        ->with('student',$student);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Student $student ,$id)
    {
        //

        $attendance=$student->attendances()->find($id);
        $form = $this->form(\App\Forms\AttendanceForm::class, [
          'method' => 'POST',
          'route' => array('students.attendance.update',\Auth::user()->roles()->first()->name,$student->_id,$id),
          'model' => $attendance,

      ]);
        return view('admins.students.attendance.edit',compact('form','student','attendance'));
    }


    public function update(\App\Student $student, $id)
    {
      $form=$this->form(\App\Forms\AttendanceForm::class);
      $attendance=$student->attendances()->find($id);
      $attendance->type=Input::get('type');
      $attendance->slot=Input::get('slot');
      $attendance->attendance_on=Input::get('attendance_on');

      $form->validate(['attendance_on' => 'date_format:"d/m/Y"|required']);
      if (!$form->isValid()) {
          return redirect()->back()->withErrors($form->getErrors())->withInput();
      }

      $collection=$student->attendances()->where('attendance_on',Input::get('attendance_on'))
      ->where('type',Input::get('type'))
      ->where('slot', Input::get('slot'))
      ->first();
     if(empty($collection))
     {
       $attendance->update();
        return redirect()->route('students.attendance.index',[\Auth::user()->roles()->first()->name,$student->_id])
        ->withSuccess("successfully updated student attendance details");
     }

     else{

      return redirect()->back()->withErrors('An Attendance Record With Same Combination Found')->withInput();

     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Student $student,$id)
    {
      $attendance=$student->attendances()->find($id);
      $student->attendances()->destroy($id);
      return redirect()->route('students.attendance.index',[\Auth::user()->roles()->first()->name,$student->_id])
      ->withSuccess("successfully deleted student attendance details");
    }
}
