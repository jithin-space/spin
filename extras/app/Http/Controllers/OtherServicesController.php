<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;

class OtherServicesController extends Controller
{
    use FormBuilderTrait;
    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }
    public function index(\App\Student $student)
    {
      return view('admins.students.other_services.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {
      $form = $this->form(\App\Forms\OtherServicesForm::class, [
        'method' => 'POST',
        'route'  => array('students.other_services.store',$student->_id),
     ]);


      return view('admins.students.other_services.create',compact('form','student'));
    }
    public function store(\App\Student $student)
    {
        echo "hello";
        $form = $this->form(\App\Forms\OtherServicesForm::class);
        \Debugbar::info($form->getFieldValues()['attachments']);
        \Debugbar::info(Input::get('start_date'));

// edition
        $a=[];
        if(isset(Input::all()['attachments']))
        {
          foreach($form->getFieldValues()['attachments'] as $attachment)
          {
            $file=\MediaUploader::fromSource($attachment)->toDestination('uploads','/student/'.$student->id)->upload();
            // $student->attachMedia($file,'attachments');
            array_push($a,$file->getUrl());
          }
        }


        // foreach($form->getFieldValues()['guardian'] as $guardian)
        // {
        //   array_push($a,$guardian);
        // }
        $os=$form->getFieldValues();
        $os['attachments']=$a;
        $os['start_date']=Input::get('start_date');
        $os['end_date']=Input::get('end_date');
        if(!isset($student->other_services))
        {
          $data=[];
          array_push($data,$os);
          $student->other_services=$data;
        }
        else {
          $data=$student->other_services;
          array_push($data,$os);
          $student->other_services=$data;
        }
        $student->save();


        return redirect()->route('students.other_services.index',$student->_id)
        ->withSuccess("successfully added student details");

    }
    public function edit(\App\Student $student,$bid)
    {

      $data=$student->other_services[$bid];
      $sid=$student->_id;
      \Debugbar::info($student->other_services[$bid]);
      $form = $this->form(\App\Forms\OtherServicesForm::class, [
        'method' => 'POST',
        'route'  => array('students.other_services.update',$student->_id,$bid),
        'model'=>$data,
        ]);

        return view('admins.students.other_services.edit',compact('form','data','sid','bid','student'));
    }

    public function update(\App\Student $student,$bid)
    {
        $form = $this->form(\App\Forms\OtherServicesForm::class);

        // edited

// edition
        $a=[];
        $os=[];
        if(isset(Input::all()['attachments'])){
          foreach(Input::all()['attachments'] as $attachment)
          {

            $file=\MediaUploader::fromSource($attachment)->toDestination('uploads','/student/'.$student->id)->upload();
            // $student->attachMedia($file,'attachments');
            array_push($a,$file->getUrl());
          }
        }

        $os=$form->getFieldValues();
        $os['start_date']=Input::get('start_date');
        $os['end_date']=Input::get('end_date');

        $d=$student->other_services;
        $e=$d[$bid];
        $data=$e['attachments'];
        if(isset($data))
        {
          $data=array_merge($data,$a);
        }
        else {
          $data=$a;
        }

        $data=array_values($data);
        $os['attachments']=$data;

        $d[$bid]=$os;
        $student->other_services=$d;

        $student->save();

        return redirect()->route('students.other_services.index',$student->_id)
        ->withSuccess("successfully updated student details");
    }
    public function destroy(\App\Student $student,$bid)
    {


          // edited

  // edition
          $a=[];
          $os=[];


          $d=$student->other_services;
          $e=$d[$bid];
          unset($d[$bid]);
          $d=array_values($d);

          $student->other_services=$d;

          $student->save();

          return redirect()->route('students.other_services.index',$student->_id);
    }
    public function show(\App\Student $student,$bid)
    {
      $a=explode(".",$bid);
      echo "hello";
      // \Debugbar::info($a);
      //  return $a;
       $d=$student->other_services;
       $e=$d[$a[0]];
       $data=$e['attachments'];
       unset($data[$a[1]]);
       $data=array_values($data);
       $e['attachments']=$data;

       $d[$a[0]]=$e;
       $student->other_services=$d;
       \Debugbar::info($e['attachments']);
       $student->save();
       return redirect()->route('students.other_services.index',$student->_id)
       ->withSuccess("successfully deleted student details");
    }
}
