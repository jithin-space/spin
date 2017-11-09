<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;



class StudentSinfoController extends Controller
{
    //
    use FormBuilderTrait;

    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }
    public function index(\App\Student $student)
    {
      return view('admins.students.school_info.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {
          $form = $this->form(\App\Forms\SchoolInfoForm::class, [
              'method' => 'POST',
              'route'  => array('students.school_info.store',$student->_id),
           ]);
              return view('admins.students.school_info.create',compact('form','student'));
    }
    public function store(\App\Student $student)
    {

      $form = $this->form(\App\Forms\SchoolInfoForm::class);
      $a=[];
      \Debugbar::info($form->getFieldValues()['school']);
      foreach($form->getFieldValues()['school'] as $school)
      {
        array_push($a,$school);
      }
      if(!isset($student->school_info))
      {
      $student->school_info=$a;
      }
      else {
        $student->school_info=array_merge($student->school_info,$a);
      }
      $student->save();

      return redirect()->route('students.school_info.index',$student->_id)
        ->withSuccess("successfully created student details");

    }
    public function edit(\App\Student $student,$bid)
    {

      \Debugbar::info($student->school_info[$bid]);
      $form = $this->form(\App\Forms\SchoolForm::class, [
        'method' => 'POST',
        'route'  => array('students.school_info.update',$student->_id,$bid),
        'model'=>$student->school_info[$bid],
        ]);

        return view('admins.students.school_info.edit',compact('form','student'));
    }
    public function update(\App\Student $student,$bid)
    {

      $form = $this->form(\App\Forms\SchoolForm::class);
      \Debugbar::info($form->getFieldValues());


      $data=$student->school_info;
  // $form=$this->form(\App\Forms\TagForm::class);
      $a=[];
      $a=$form->getFieldValues();
      $data[$bid]=$a;
      $student->school_info=$data;
      $student->save();

    return redirect()->route('students.school_info.index',$student->_id)
      ->withSuccess("successfully updated student details");
    }
    public function destroy(\App\Student $student,$bid)
    {

      $data=$student->school_info;
      unset($data[$bid]);
      array_values($data);
      $student->school_info=$data;
      $student->save();

      return redirect()->route('students.school_info.index',$student->_id)
        ->withSuccess("successfully deleted student details");;
    }
}
