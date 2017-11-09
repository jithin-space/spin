<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;


class StudentBinfoController extends Controller
{
    use FormBuilderTrait;

    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }

    public function index(\App\Student $student)
    {
      return view('admins.students.background_info.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {


      $form = $this->form(\App\Forms\BackgroundInfoForm::class, [
        'method' => 'POST',
        'route'  => array('students.background_info.store',$student->_id),
     ]);


        return view('admins.students.background_info.create',compact('form','student'));
    }

    public function store(\App\Student $student)
    {
      if(!isset($student->background_info))
      {

      $student->background_info=Input::get('tags');
      }
      else {
        $student->background_info=array_merge($student->background_info,Input::get('tags'));
      }
      $student->save();
      return redirect()->route('students.background_info.index',$student->_id)
      ->withSuccess("successfully created student details");


    }

    public function edit(\App\Student $student,$bid)
    {

      $form = $this->form(\App\Forms\TagForm::class, [
        'method' => 'POST',
        'route'  => array('students.background_info.update',$student->_id,$bid),
        'model'=>$student->background_info[$bid],
        ]);

        return view('admins.students.background_info.edit',compact('form','student'));
    }

    public function update(\App\Student $student,$bid)
    {
      $data=$student->background_info;
      $a=[];
      $a['Info_Type']=Input::get('Info_Type');
      $a['Description']=Input::get('Description');
      $data[$bid]=$a;
      $student->background_info=$data;
      $student->save();
      return redirect()->route('students.background_info.index',$student->_id)
      ->withSuccess("successfully updated student details");

    }

    public function destroy(\App\Student $student,$bid)
    {
      $data=$student->background_info;
      unset($data[$bid]);
      array_values($data);
      $student->background_info=$data;
      $student->save();
      return redirect()->route('students.background_info.index',$student->_id)
      ->withSuccess("successfully deleted student details");
    }
}
