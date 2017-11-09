<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Request;
use Debugbar;

class AssignController extends Controller
{
    //
    use FormBuilderTrait;
    public function __construct()
    {
      $this->middleware('role:admin');
    }
    public function index()
    {
        return view('admins.assigns.index')
          ->with('students',\App\Student::all());

    }

    public function edit($id)
    {
              $student=\App\Student::find($id);
              $assigned=$student->user_ids;
              $assigned=is_null($assigned)?[]:$assigned;
              $users=\App\UserMongo::whereNotIn('id',$assigned)->get();
              $data=array('users'=>$users,'student'=>$student);
              return view('admins.assigns.edit')
                ->with('data',$data );

    }

    public function update($_id)
    {
       $ar=array();
       $id=is_null(Request::input('id'))?[]:Request::input('id');
      //  \Debugbar::info(Request::input('id'));
       foreach($id as $i):
        //  $ar.append((int)$i);
        array_push($ar,(int)$i);
       endforeach;
       \App\Student::find($_id)->support_team()->attach($ar);
      //  \Debugbar::info($ar);
       return redirect()->route('assign.index')
           ->withSuccess("successfully updated assignment details");
    }

    public function destroy($id)
    {
      $u_id=(int)$id;
      $s_id=Request::input('sid');
      \App\Student::find($s_id)->support_team()->detach($u_id);
        return redirect()->route('assign.index')
            ->withSuccess('successfully unassigned the user');
    }

}
