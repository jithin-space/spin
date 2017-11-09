<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Plank\Mediable\Media;
use App\Services\IepService;
use Illuminate\Support\Facades\Input;
use Debugbar;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class StudentController extends Controller
{
    //
    use FormBuilderTrait;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'students.fname' => 10,
            'students.lname' => 5,
        ],
    ];

    protected $student;
    public function __construct()
    {
      $this->middleware('role:admin', ['except' => ['index', 'show']]);
      $this->iep=new IepService;
    }

    

    // public function scopeWhereFullText($query, $search)
    // {
    //     return $query->whereRaw(array('$text' => array('$search' => $search)));
    // }

    public function index(Request $request)
    {
      $page=1;
      if(isset($request->id))
      {
        $count= \App\Student::where('student_id','<',$request->id)->count();
        $page= (int)($count/5)+1;
        return redirect()->route('students.index',[\Auth::user()->roles()->first()->name,'page'=>$page]);

      }

        $student=\App\Student::orderBy('fname','asc')->paginate(20);

        return view('admins.students.index')
          ->with('students',$student);

    }

    public function create()
    {


          // return view('students.create');

          $form = $this->form(\App\Forms\StudentForm::class, [
            'method' => 'POST',
            'route' => array('students.store',\Auth::user()->roles()->first()->name),
        ]);
          return view('admins.students.create',compact('form'));
    }
    public function edit(\App\Student $student)
    {

                $form = $this->form(\App\Forms\StudentForm::class, [
                  'method' => 'POST',
                  'route' => array('students.update',\Auth::user()->roles()->first()->name,$student->_id),
                  'model' => $student
              ]);
                return view('admins.students.edit',compact('form','student'));
    }
  //
    public function update(\App\Student $student)
    {
          $form = $this->form(\App\Forms\StudentForm::class, [
            'model' => $student
        ]);
        $form->validate(['student_id'=>'required|unique:mongodb.students,student_id,'.$student->_id.',_id']);

        //$form->redirectIfNotValid();
        if (!$form->isValid()) {
           return redirect()->back()->withErrors($form->getErrors())->withInput();
       }

        \App\Student::where('_id',$student->_id)->update($form->getFieldValues());

        if(Input::hasFile('profile')){
          $profile=\MediaUploader::fromSource(Input::file('profile'))->toDestination('uploads','/student/'.$student->_id)->upload();
          $student->syncMedia($profile,'profile');
        }

        $student->save();


        return redirect()->route('students.index',\Auth::user()->roles()->first()->name)
            ->withSuccess("successfully updated student details");
    }

    public function store(Request $request)
    {
      $form=$this->form(\App\Forms\StudentForm::class);

      $form->validate(['student_id'=>'required|unique:mongodb.students,student_id']);
      if (!$form->isValid()) {
         return redirect()->back()->withErrors($form->getErrors())->withInput();
     }
      $student = new \App\Student;
      $student->fname=$request->fname;
      $student->lname=$request->lname;
      $student->student_id=$request->student_id;
      $student->save();
      if(Input::hasFile('profile')){
        $profile=\MediaUploader::fromSource(Input::file('profile'))->toDestination('uploads','/student/'.$student->id)->upload();
      }
      else{
        $profile=\App\Media::find(6);
      }

      $student->attachMedia($profile,'profile');
      echo $profile->getUrl();

      return redirect()->route('students.index',\Auth::user()->roles()->first()->name)
            ->withSuccess('successfully created a new student');
    }

    public function destroy(\App\Student $student)
    {
        $student->delete();
        return redirect()->route('students.index',\Auth::user()->roles()->first()->name)
            ->withSuccess('successfully deleted the user');
    }
  //
  //   public function home($id)
  //   {
  //     $student=\App\Students::find($id);
  //     return view('students.home')
  //       ->with('student',$student);
  //   }

  public function show($id)
  {

        $student=\App\Student::find($id);
        return view('admins.students.home')
          ->with('student',$student);
  }



}
