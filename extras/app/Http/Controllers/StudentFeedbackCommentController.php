<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Debugbar;
use Kris\LaravelFormBuilder\FormBuilderTrait;


class StudentFeedbackCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct(){

    }


    public function store($sid,$fid)
    {
      echo $fid;

      $comment=new \App\Comment;
      $comment->content=Input::get('comment');
      $comment->author=\Auth::user()->name;

      $student=\App\Student::find($sid);
      $iep=$student->feedbacks()->find($fid);

      $iep->comments()->save($comment);

      $iep->update();

      $student=\App\Student::find($sid);
      $iep=$student->feedbacks()->find($fid);
      return redirect()->back();

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
