<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;
class StudentFeedbackController extends Controller
{
    //

    use FormBuilderTrait;

    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show','create','store','edit','update']]);
    }

    public function index(\App\Student $student)
    {
      return view('all.feedback.index')
      ->with('student',$student);
    }

    public function create(\App\Student $student)
    {

      $form = $this->form(\App\Forms\FeedbackForm::class, [
        'method' => 'POST',
        'route' => array('students.feedback.store',\Auth::user()->roles()->first()->name,$student->_id),
        ]);

      $form->add('student_id','hidden',['rules' => 'required|min:5', 'attr'=>['disabled', 'id'=>'123'],'value'=>$student->_id]);
      $form->add('created_by','text',['rules' => 'required|min:5', 'attr'=>['disabled', 'id'=>'123'],'value'=>\Auth::user()->name]);
      $form->add('feedback_type','hidden',['rules' => 'required|min:5']);
      $form->add('content','textarea',['attr'=>['id'=>'summernote'],'value'=>'enter your feedback here']);
      return view('all.feedback.create',compact('form','student'));

      // return view('all.feedback.create');
    }

    public function edit(\App\Student $student,$fid)
    {
      $feedback=$student->feedbacks()->find($fid);
      $form = $this->form(\App\Forms\FeedbackForm::class, [
        'method' => 'POST',
        'route' => array('students.feedback.update',\Auth::user()->roles()->first()->name,$student->_id,$fid),
    ]);
    $form->add('student_id','hidden',['rules' => 'required|min:5', 'attr'=>['disabled', 'id'=>'123'],'value'=>$student->name]);
    $form->add('created_by','text',['rules' => 'required|min:5', 'attr'=>['disabled', 'id'=>'123'],'value'=>$feedback->created_by]);
    $form->add('content','textarea',['attr'=>['id'=>'summernote'],'value'=>$feedback->content]);

      return view('all.feedback.edit',compact('form','student'));


    }
    public function store(\App\Student $student)
    {

      $feedback=new \App\Feedback;
      $feedback->content=Input::get('content');
      $feedback->created_by=\Auth::user()->name;
      $feedback->creator_id=\Auth::user()->id;
      $student->feedbacks()->save($feedback);
      return redirect()->route('students.feedback.index',[\Auth::user()->roles()->first()->name,$student->_id])
      ->withSuccess("successfully added feedback details");
    }

    public function update(\App\Student $student,$fid)
    {
      $feedback=$student->feedbacks()->find($fid);
      $feedback->content=Input::get('content');
      $feedback->update();
      return redirect()->route('students.feedback.index',[\Auth::user()->roles()->first()->name,$student->_id])->
      withSuccess("successfully updated feedback details");
    }

    public function destroy(\App\Student $student,$fid)
    {
      $feedback=$student->feedbacks()->find($fid);
      $student->feedbacks()->destroy($feedback);
      return redirect()->route('students.feedback.index',[\Auth::user()->roles()->first()->name,$student->_id])
      ->withSuccess("successfully deleted feedback details");
    }
}
