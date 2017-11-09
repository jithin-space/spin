<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;
class StudentMedInfoController extends Controller
{

    use FormBuilderTrait;

    public function __construct(){
      $this->middleware('role:admin',['except'=>['index','show']]);
    }
    public function index(\App\Student $student)
    {

      return view('admins.students.med_info.index')
      ->with('student',$student);
    }
    public function create(\App\Student $student)
    {
      $form = $this->form(\App\Forms\MedicationInfoForm::class, [
          'method' => 'POST',
          'route'  => array('students.med_info.store',$student->_id),
       ]);
          return view('admins.students.med_info.create',compact('form','student'));
    }

    public function store(\App\Student $student)
    {
          $form = $this->form(\App\Forms\MedicationInfoForm::class);

          \Debugbar::info($form->getFieldValues());
          $form = $this->form(\App\Forms\MedicationInfoForm::class);
          $info=$form->getFieldValues();
          $info['start_date']=Input::get('start_date');
          $info['end_date']=Input::get('end_date');
          $a=[];
          array_push($a,$info);
          if(!isset($student->medication_info))
          {

          $student->medication_info=$a;
          }
          else {
            $student->medication_info=array_merge($student->medication_info,$a);
          }
          $student->save();

          return redirect()->route('students.med_info.index',$student->_id)
          ->withSuccess("successfully updated student details");
          // return view('admins.students.home')
          //   ->with('student',$student);
    }
    public function edit(\App\Student $student,$bid)
    {

        $data=$student->medication_info[$bid];
        $form = $this->form(\App\Forms\MedicationInfoForm::class, [
        'method' => 'POST',
        'route'  => array('students.med_info.update',$student->_id,$bid),
        'model'=>$data,
        ]);

        return view('admins.students.med_info.edit',compact('form','data','student'));
    }
    public function update(\App\Student $student,$bid)
    {

      $form = $this->form(\App\Forms\MedicationInfoForm::class);

      $data=$student->medication_info;

      $a=[];
      $a=$form->getFieldValues();
      $a['start_date']=Input::get('start_date');
      $a['end_date']=Input::get('end_date');
      $data[$bid]=$a;
      $student->medication_info=$data;
      $student->save();
      return redirect()->route('students.med_info.index',$student->_id)
      ->withSuccess("successfully edited student details");
    }
    public function destroy(\App\Student $student,$bid)
    {

      $data=$student->medication_info;
      unset($data[$bid]);
      array_values($data);
      $student->medication_info=$data;
      $student->save();
      return redirect()->route('students.med_info.index',$student->_id)
      ->withSuccess("successfully deleted student details");
    }
}
