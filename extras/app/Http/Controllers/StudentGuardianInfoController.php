<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;


class StudentGuardianInfoController extends Controller
{
    //
    use FormBuilderTrait;
    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }
    public function index(\App\Student $student)
    {
      return view('admins.students.guardian_info.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {
            $form = $this->form(\App\Forms\GuardianInfoForm::class, [
              'method' => 'POST',
              'route'  => array('students.guardian_info.store',$student->_id),
           ]);


            return view('admins.students.guardian_info.create',compact('form','student'));
    }
    public function store(\App\Student $student)
    {
      $form = $this->form(\App\Forms\GuardianInfoForm::class);
      $a=[];
      foreach($form->getFieldValues()['guardian'] as $guardian)
      {
        array_push($a,$guardian);
      }
      if(!isset($student->guardian_info))
      {

      $student->guardian_info=$a;
      }
      else {
        $student->guardian_info=array_merge($student->guardian_info,$a);
      }
      $student->save();
      return redirect()->route('students.guardian_info.index',$student->_id)
      ->withSuccess("successfully created student details");

    }
    public function edit(\App\Student $student,$bid)
    {

      $form = $this->form(\App\Forms\ParentForm::class, [
        'method' => 'POST',
        'route'  => array('students.guardian_info.update',$student->_id,$bid),
        'model'=>$student->guardian_info[$bid],
        ]);

        return view('admins.students.guardian_info.edit',compact('form','student'));
    }
    public function update(\App\Student $student,$bid)
    {
      $form = $this->form(\App\Forms\ParentForm::class);
      $data=$student->guardian_info;
      $a=[];
      $a=$form->getFieldValues();
      $data[$bid]=$a;
      $student->guardian_info=$data;
      $student->save();
      return redirect()->route('students.guardian_info.index',$student->_id)
      ->withSuccess("successfully updated student details");
    }

    public function destroy(\App\Student $student,$bid)
    {
      $data=$student->guardian_info;
      unset($data[$bid]);
      array_values($data);
      $student->guardian_info=$data;
      $student->save();
      return redirect()->route('students.guardian_info.index',$student->_id)
      ->withSuccess("successfully deleted student details");

    }
}
