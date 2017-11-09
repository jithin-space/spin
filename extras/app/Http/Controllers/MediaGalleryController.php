<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;

class MediaGalleryController extends Controller
{
  use FormBuilderTrait;
  public function index($sid)
  {
    return view('admins.students.media_gallery.index')
    ->with('student',\App\Student::find($sid));
  }
    public function create($sid)
    {
      $form = $this->form(\App\Forms\MediaGalleryForm::class, [
        'method' => 'POST',
        'route'  => array('students.media_gallery.store',$sid),
     ]);


      return view('admins.students.media_gallery.create',compact('form'));
    }
    public function store($sid)
    {
      echo "hello";
      $student=\App\Student::find($sid);
      $a=[];
      $form = $this->form(\App\Forms\MediaGalleryForm::class);
      \Debugbar::info($form->getFieldValues()['media_type']);
      foreach($form->getFieldValues()['gallery'] as $attachment)
      {
        echo "hello";
        $file=\MediaUploader::fromSource($attachment)->toDestination('uploads','/student/'.$student->id)->upload();
        $student->attachMedia($file,['gallery',$form->getFieldValues()['media_type']]);
      }
      $student->save();
      $student=\App\Student::find($sid);
      return view('admins.students.home')
        ->with('student',$student);
    }
    public function edit($sid,$gid)
    {

    }
    public function update($sid,$gid)
    {

    }
    public function destroy($sid,$gid)
    {
      $student=\App\Student::find($sid);
      $student->getMedia('gallery')[$gid];
      echo "hello";
      \Debugbar::info($student->getMedia('gallery')[$gid]);
      $media=$student->getMedia('gallery')[$gid];
      $student->detachMedia($media);
      $student->save();
      $student=\App\Student::find($sid);
      return view('admins.students.home')
        ->with('student',$student);


    }
}
