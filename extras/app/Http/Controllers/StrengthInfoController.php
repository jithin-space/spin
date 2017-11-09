<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;

class StrengthInfoController extends Controller
{
    //
    use FormBuilderTrait;
    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }
    public function index(\App\Student $student)
    {
      return view('admins.students.strength_info.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {
      //
      $form = $this->form(\App\Forms\StrengthInfoForm::class, [
        'method' => 'POST',
        'route' => array('students.strength_info.store',$student->_id),
        ]);

      return view('admins.students.strength_info.create',compact('form','student'));
    }

    public function store(\App\Student $student)
    {

      $form = $this->form(\App\Forms\StrengthInfoForm::class);
      $a=[];
      $a['strength']=[];
      $a['weakness']=[];
      $a['special_interests']=[];
      // \Debugbar::info($form->getFieldValues()['strength']);
      if(isset($form->getFieldValues()['strength']) )
      {
        foreach($form->getFieldValues()['strength'] as $str)
        {
          // \Debugbar::info($str);
          if(isset($str['name']))
          {
          array_push($a['strength'],$str);
          }
          // \Debugbar::info('hello');
        }
        array_values($a['strength']);
      }
      if(isset($form->getFieldValues()['weakness']))
      {
      foreach($form->getFieldValues()['weakness'] as $str)
      {
        if(isset($str['name']))
        {
        array_push($a['weakness'],$str);
        }
      }
      array_values($a['weakness']);
    }
      if(isset($form->getFieldValues()['special_interests']))
      {
      foreach($form->getFieldValues()['special_interests'] as $str)
      {
        if(isset($str['name']))
        {
        array_push($a['special_interests'],$str);
        }
      }
      array_values($a['special_interests']);
    }

      if(!isset($student->strength_info))
      {
        $student->strength_info=$a;

        \Debugbar::info($a);
      }
      else {
        \Debugbar::info($student->strength_info);

        $a['strength']=array_merge($student->strength_info['strength'],$a['strength']);
        $a['weakness']=array_merge($student->strength_info['weakness'],$a['weakness']);
        $a['special_interests']=array_merge($student->strength_info['special_interests'],$a['special_interests']);
        $student->strength_info=$a;
          \Debugbar::info($a);
      }
      $student->save();
      return redirect()->route('students.strength_info.index',$student->_id)
        ->withSuccess("successfully added student details");
    }

    public function edit(\App\Student $student,$bid)
    {


      $a=explode(".",$bid);
      if($a[1]=='1')
      {
        $form = $this->form(\App\Forms\StrengthForm::class, [
          'method' => 'POST',
          'route'  => array('students.strength_info.update',$student->_id,$bid),
          'model'=>$student->strength_info['strength'][$a[0]],
          ]);

          return view('admins.students.strength_info.edit',compact('form','a','student'));
      }
      else if($a[1]=='2')
      {
        $form = $this->form(\App\Forms\WeaknessForm::class, [
          'method' => 'POST',
          'route'  => array('students.strength_info.update',$student->_id,$bid),
          'model'=>$student->strength_info['weakness'][$a[0]],
          ]);

          return view('admins.students.strength_info.edit',compact('form','a','student'));
      }
      else if($a[1]=='3')
      {
        $form = $this->form(\App\Forms\SpecialInterestsForm::class, [
          'method' => 'POST',
          'route'  => array('students.strength_info.update',$student->_id,$bid),
          'model'=>$student->strength_info['special_interests'][$a[0]],
          ]);

          return view('admins.students.strength_info.edit',compact('form','a','student'));
      }
    }
    public function update(\App\Student $student,$bid)
    {

      $a=explode(".",$bid);
      if($a[1]=='1')
      {
        $form = $this->form(\App\Forms\StrengthForm::class);
        $da=$student->strength_info;
        $data=$da['strength'];
    // $form=$this->form(\App\Forms\TagForm::class);
        $b=[];
        $b=$form->getFieldValues();
        $data[$a[0]]=$b;
        $da['strength']=$data;
        $student->strength_info=$da;
        $student->save();

        return redirect()->route('students.strength_info.index',$student->_id);


      }
      else if($a[1]=='2')
      {
        $form = $this->form(\App\Forms\WeaknessForm::class);

        $da=$student->strength_info;
        $data=$da['weakness'];
    // $form=$this->form(\App\Forms\TagForm::class);
        $b=[];
        $b=$form->getFieldValues();
        $data[$a[0]]=$b;
        $da['weakness']=$data;
        $student->strength_info=$da;
        $student->save();

          return redirect()->route('students.strength_info.index',$student->_id);
      }
      else if($a[1]=='3')
      {
        $form = $this->form(\App\Forms\SpecialInterestsForm::class);

        $da=$student->strength_info;
        $data=$da['special_interests'];
    // $form=$this->form(\App\Forms\TagForm::class);
        $b=[];
        $b=$form->getFieldValues();
        $data[$a[0]]=$b;
        $da['special_interests']=$data;
        $student->strength_info=$da;
        $student->save();

          return redirect()->route('students.strength_info.index',$student->_id)
            ->withSuccess("successfully edited student details");
      }
    }
    public function destroy(\App\Student $student,$bid)
    {

      $a=explode(".",$bid);

      $da=$student->strength_info;
      if($a[1]=='1')
      {
        $data=$da['strength'];
        unset($data[$a[0]]);
        array_values($data);
        $da['strength']=$data;
      }
      else if($a[1]=='2')
      {
        $data=$da['weakness'];
        unset($data[$a[0]]);
        array_values($data);
        $da['weakness']=$data;
      }
      else if($a[1]=='3')
      {
        $data=$da['special_interests'];
        unset($data[$a[0]]);
        array_values($data);
        $da['special_interests']=$data;
      }
      array_values($da);
      $student->strength_info=$da;
      $student->save();

      return redirect()->route('students.strength_info.index',$student->_id)
        ->withSuccess("successfully deleted student details");
    }
}
