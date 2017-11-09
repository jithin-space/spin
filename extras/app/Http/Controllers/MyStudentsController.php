<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Debugbar;

use Kris\LaravelFormBuilder\FormBuilderTrait;


class MyStudentsController extends Controller
{
    use FormBuilderTrait;
    public function check()
    {
      //dynamic form builder working example

        // echo "{{ \Auth::user()->name }}";
        //  $id=\Auth::user()->id;
        //  $usermongo=\App\UserMongo::find((int)$id);
        //  $students=$usermongo->students;
        //  \Debugbar::info($students);
        // return view('teachers.mystudents.index')
        //  ->with('students',$students);

        $form = $this->form(\App\Forms\PostForm::class, [
          'method' => 'POST',
          'route' => 'students.store'
      ]);
        return view('teachers.mystudents.edit',compact('form'));
    }

    // public function index()
    // {
    //   $user=\App\UserMongo::find(\Auth::user()->id);
    //   \Debugbar::info($user->students);
    //   return view('teachers.mystudents.index')
    //   ->with('students',$user->students);
    // }
    public function index()
    {
        $student=\App\Student::paginate(5);

        return view('teachers.mystudents.index')
          ->with('students',$student);

    }

    public function show($id)
    {
        $student=\App\Student::find($id);
        return view('teachers.mystudents.home')
          ->with('student',$student);
    }
}
