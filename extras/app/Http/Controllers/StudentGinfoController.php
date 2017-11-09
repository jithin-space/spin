<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;
class StudentGinfoController extends Controller
{
    //
        use FormBuilderTrait;
        public function __construct(){
          $this->middleware('role:admin',['except'=>['index','show']]);
        }
        
        public function index(\App\Student $student)
        {
          return view('admins.students.general_info.index')
          ->with('student',$student);
        }

        public function create(\App\Student $student)
        {
          $disabilities=\App\Vocabulary::find(4)->terms;
          $a=[];
          foreach($disabilities as $dis)
          {
            $a[$dis->id]=$dis->name;
          }
          $form = $this->form(\App\Forms\GeneralInfoForm::class, [
            'method' => 'POST',
            'route' => array('students.general_info.store',$student->_id),
            ]);
          $form->add('First_Name','text',['attr'=>['disabled'],'value'=>$student->fname]);
          $form->add('Last_Name','text',['attr'=>['disabled'],'value'=>$student->lname]);
          // $form->add('created_by','text',['rules' => 'required|min:5', 'attr'=>['disabled', 'id'=>'123'],'value'=>\Auth::user()->name]);
          $form->add('Student_Number','hidden',['value'=>123]);
          $form->add('Disabilities', 'select', [
              'choices' => $a,
              'attr'=>['multiple'=>'multiple','class'=>'selectpicker']
          ]);
          return view('admins.students.general_info.create',compact('form','student'));
        }

        public function edit(\App\Student $student,$did)
        {
          $general_info=$student->general_info;
          $disabilities=\App\Vocabulary::find(4)->terms;
          $a=[];
          $b=[];
          foreach($disabilities as $dis)
          {
            $a[$dis->id]=$dis->name;
          }

          $selected=$student->disabilities;
          foreach($selected as $select)
          {
            array_push($b,$select->id);
          }

           $data=array('info'=>$general_info,'categories'=>$a,'selected'=>$b,'sid'=>$student->_id,'student'=>$student);
          return view('admins.students.general_info.edit')
          ->with('data',$data);

        }


        public function store(\App\Student $student)
        {
          $a=[];
          $a['fname']=$student->fname;
          $a['lname']=$student->lname;
          $a['date_of_birth']=Input::get('date_of_birth');
          $a['date_of_joining']=Input::get('date_of_joining');
          $a['gender']=Input::get('gender');
          $student->general_info=$a;
          if( null !== Input::get('Disabilities'))
          {
            foreach(Input::get('Disabilities') as $dis)
            {
              $term=\App\Term::find($dis);
              \Debugbar::info($term);
              $student->disabilities()->save($term);
            }

          }
          $student->save();
        return redirect()->route('students.general_info.index',$student->_id)
                          ->withSuccess("successfully created student details");
        }
        public function update(\App\Student $student,$gid)
        {
          $a=[];
          $a['fname']=$student->fname;
          $a['lname']=$student->lname;
          $a['date_of_birth']=Input::get('date_of_birth');
          $a['date_of_joining']=Input::get('date_of_joining');
          $a['gender']=Input::get('gender');
          $student->general_info=$a;
          $student->disabilities()->detach();
          if( null !== Input::get('Disabilities'))
          {
            foreach(Input::get('Disabilities') as $dis)
            {
              $term=\App\Term::find($dis);
              $student->disabilities()->save($term);
            }

          }
          $student->save();
          return redirect()->route('students.general_info.index',$student->_id)
                      ->withSuccess("successfully updated student details");

        }

        public function destroy(\App\Student $student,$id)
        {
          $student->general_info=[];
          $student->disabilities()->detach();
          $student->save();
            return redirect()->route('students.general_info.index',$student->_id)
                              ->withSuccess("successfully deleted student details");
        }


}
