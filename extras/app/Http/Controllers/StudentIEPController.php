<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Debugbar;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class StudentIEPController extends Controller
{
    use FormBuilderTrait;
    protected $student;
    public function __construct()
    {
      // $this->middleware('role:admin',['except'=>['index','show']]);
    }

    public function showActive(\App\Student $student){

       return view('admins.students.iep.active')
         ->with('student',$student);
    }

    public function index(\App\Student $student)
    {
      return view('admins.students.iep.home')
      ->with('student',$student);
    }

    public function create(\App\Student $student)
    {
      $iep_voc=\App\Vocabulary::find(1);
      $goal_areas=$iep_voc->terms()->orderBy('name')->get();
      \Debugbar::info($goal_areas);
      $data=array('goals'=>$goal_areas,'sid'=>$student->_id,'student'=>$student);
      return view('admins.students.iep.create')
        ->with('data',$data);
    }


    public function store(\App\Student $student)
    {
      $iep=new \App\IEP;
      $iep->goal_area=\App\Term::find(Input::get('goal_area'))->parent;
      $iep->goal_area_description=\App\Vocabulary::find($iep->goal_area)->name;
      $iep->long_term_objective=Input::get('lto');
      $iep->lto_description=\App\Term::find($iep->long_term_objective)->name;
      $iep->description=Input::get('description');
      $iep->status=Input::get('status');
      $iep->example_activity=Input::get('example_activity');
      $student->ieps()->save($iep);
      $iep->date=$student->updated_at;
      $iep->update;
      return redirect()->route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])
          ->withSuccess("successfully created an IEP");
    }

    public function edit(\App\Student $student,$iep_id)
    {
      $iep_voc=\App\Vocabulary::find(1);
      $goal_areas=$iep_voc->terms()->orderBy('name')->get();


        $iep=$student->ieps()->find($iep_id);
\Debugbar::info($iep->goal_area);
        $ltos=\App\Vocabulary::find($iep->goal_area)->terms;


          $data=array('iep'=>$iep,'sid'=>$student->_id,'student'=>$student,'goals'=>$goal_areas,'ltos'=>$ltos);
          // \Debugbar::info($data['iep']['example_activity']);
           return view('admins.students.iep.edit')
            ->with('data',$data);
    }
    public function update(\App\Student $student,$iep_id)
    {

      $iep=$student->ieps()->find($iep_id);

      $iep->goal_area=\App\Term::find(Input::get('goal_area'))->parent;
      $iep->goal_area_description=\App\Vocabulary::find($iep->goal_area)->name;
      $iep->long_term_objective=Input::get('lto');
      $iep->lto_description=\App\Term::find($iep->long_term_objective)->name;

      $iep->description=Input::get('desc');
      $status=$iep->status;
      $iep->status=Input::get('status');
      \Debugbar::info(Input::get('example_activity'));
      $iep->example_activity=Input::get('example_activity');
      $iep->update();
      if($iep->status != $status){
        $iep->date=$iep->updated_at;
      }
      $iep->update();

      return redirect(url()->previous())
            ->withSuccess('successfully edited  IEP details');
      // return redirect()->route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])
      //   ->withSuccess("successfully edited  IEP details");
    }
    public function destroy(\App\Student $student,$iep_id)
    {
      $iep=$student->ieps()->find($iep_id);
      $student->ieps()->destroy($iep);
      return redirect()->route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])
            ->withSuccess('successfully deleted an IEP');
      // return redirect()->route('students.iep.index',[\Auth::user()->roles()->first()->name,$student->_id])
      //   ->withSuccess("successfully deleted an IEP");

    }

    public function show(\App\Student $student, $id)
    {
        $iep=$student->ieps()->find($id);
        \Debugbar::info($iep->date);
        return view('admins.students.iep.show')->with('data',[$student,$iep]);
    }
}
