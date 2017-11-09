<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Debugbar;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class StudentIEPCommentController extends Controller
{
    //

    public function __construct(){

    }

    public function create($sid,$iepid)
    {
        echo "hello world";
        return "hello";
    }

    public function store($sid,$iep_id)
    {
      echo $iep_id;

      $comment=new \App\Comment;
      $comment->content=Input::get('comment');
      $comment->author=\Auth::user()->name;

      $student=\App\Student::find($sid);
      $iep=$student->ieps()->find($iep_id);

      $iep->comments()->save($comment);

      $iep->update();

      $student=\App\Student::find($sid);
      $iep=$student->ieps()->find($iep_id);

      \Debugbar::info($iep->comments()->find($comment->_id)->content);


        return redirect()->back();
    
    }
}
