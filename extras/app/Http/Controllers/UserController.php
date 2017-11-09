<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class UserController extends Controller
{
    //
    use FormBuilderTrait;

    public function __construct()
    {
       $this->middleware('role:admin', ['except' => ['index', 'show']]);

    }

    public function index()
    {


       $users=\App\User::paginate(5);

       return view('admins.users.home')
         ->with('users',$users);


    }
    public function create()
    {
          // $form= $formBuilder->create( \App\Forms\UserForm::class,['method'=>'POST' ,'route'=>'users.store' ]);
          $roles=\App\Role::all();
          $a=[];
          foreach($roles as $role)
          {
            $b=[];
            foreach($role->subroles as $subrole)
            {
              $b[$role->id.'_'.$subrole->id]=$subrole->name;
            }
            if(!empty($b)){
              $a[$role->name]=$b;
            }
            else{
              $b[$role->id.'_0']=$role->name;
              $a[$role->name]=$b;
            }


          }

          // dd($a);

          $form = $this->form(\App\Forms\UserForm::class, [
            'method' => 'POST',
            'route' => array('users.store',\Auth::user()->roles()->first()->name),
        ]);

        $form->add('Role', 'select', [
            'choices' => $a,
            'attr'=>['class'=>'selectpicker']
        ]);
        $form->add('password', 'repeated', [
            'type' => 'password',
            'second_name' => 'password_confirmation',
            'first_options' => [],
            'second_options' => [],
            'rules'=>'required|confirmed',
        ]);
        return view('admins.users.create',compact('form'));
    }

    public function store( Request $request )
    {
      $form = $this->form(\App\Forms\UserForm::class);
        $form->validate(['name'=>'required|unique:roles|min:4','email'=>'required|unique:users|email']);
      if (!$form->isValid()) {
           return redirect()->back()->withErrors($form->getErrors())->withInput();
       }

       $req=$form->getFieldValues();
       $user=new \App\User;
       $usermongo=new \App\UserMongo;
       $usermongo->fname=$request->name;
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=Hash::make(Input::get('password'));

      $user->save();
      $sid=Input::get('Role');
      echo Input::get('Role');

      $a=explode('_',$sid);
      if($a[1]=='0')
      {
         $user->roles()->attach($a[0]);
      }
      else {
        $user->subroles()->attach($a[1]);
        $user->roles()->attach($a[0]);
      }

      $user->usermongo()->save($usermongo);
      return redirect()->route('users.index',\Auth::user()->roles()->first()->name)
             ->withSuccess('successfully created a new user');

    }

    public function edit(\App\User $user)
    {


                $form = $this->form(\App\Forms\UserForm::class, [
                  'method' => 'POST',
                  'route' => array('users.update',\Auth::user()->roles()->first()->name,$user->id),
                  'model' => $user
              ]);

              $form->add('change_passwd', 'checkbox', [
                    'value' => 0,
                    'checked' => false
                ]);
              $form->remove('password');

              $form->add('current_password', 'password',['attr'=>['disabled'=>true]]);

              $form->add('new_password', 'repeated', [
                  'type' => 'password',
                  'second_name' => 'new_password_confirmation',
                  'first_options' => ['label'=>'New Password','attr'=>['disabled'=>true],'value'=>''],
                  'second_options' => ['attr'=>['disabled'=>true]],
              ]);



              $roles=\App\Role::all();
              $a=[];
              foreach($roles as $role)
              {
                $b=[];
                foreach($role->subroles as $subrole)
                {
                  $b[$role->id.'_'.$subrole->id]=$subrole->name;
                }
                if(!empty($b)){
                  $a[$role->name]=$b;
                }
                else{
                  $b[$role->id.'_0']=$role->name;
                  $a[$role->name]=$b;
                }


              }


               \Debugbar::info($user->roles[0]->id);
               if($user->subroles()->count()==0)
               {
                 $subrole_id=0;
                 $subrole_name=$user->roles[0]->name;
               }
               else {
                 $subrole_id=$user->subroles[0]->id;
                 $subrole_name=$user->subroles[0]->name;
               }
              $form->add('Role', 'select', [
                  'choices' => $a,
                  'attr'=>['class'=>'selectpicker'],
                  'selected'=> [$user->roles[0]->id.'_'.$subrole_id,$subrole_name],
                ]);

              return view('admins.users.edit',compact('form'));

    }

    public function update(\App\User $user)
    {


      $form = $this->form(\App\Forms\UserForm::class);
      $form->validate(['name'=>'required|unique:users,name,'.$user->id.',id|min:4','email'=>'required|unique:users,email,'.$user->id.',id|email']);
      $error=$form->getErrors();
      if(!(Input::get('change_passwd')== null) )
      {

      $form->validate(['name'=>'required|unique:users,name,'.$user->id.',id|min:4',
      'email'=>'required|unique:users,email,'.$user->id.',id|email',
        'new_password'=>'required|confirmed','current_password'=>'required']);
      $error=$form->getErrors();
      if(!(Hash::check(Input::get('current_password'), $user->password)))
        {
              $error['current_password']=isset($error['current_password'])?$error['current_password']:['input password not matching with existing password'];
              return redirect()->back()->withErrors($error)->withInput();
        }
      }

      if(!$form->isValid())
      {
         return redirect()->back()->withErrors($error)->withInput();
      }
      $user->name=Input::get('name');
      $user->email=Input::get('email');
      if(null != Input::get('new_password'))
      {
        $user->password=Hash::make(Input::get('new_password'));
      }
      $user->save();

      $user->roles()->detach();
      $user->subroles()->detach();


      $sid=Input::get('Role');
      echo Input::get('Role');

      $a=explode('_',$sid);
      if($a[1]=='0')
      {
         $user->roles()->attach($a[0]);
      }
      else {
        $user->subroles()->attach($a[1]);
        $user->roles()->attach($a[0]);
      }


      return redirect()->route('users.index',\Auth::user()->roles()->first()->name)
             ->withSuccess('successfully edited user details');
    }

    public function destroy(\App\User $user)
    {
      $user->roles()->detach();
      $user->subroles()->detach();
      $user->usermongo()->delete();
      $user->delete();
        return redirect()->route('users.index',\Auth::user()->roles()->first()->name)
            ->withSuccess('successfully deleted the user');
    }

    public function show($id)
    {
      echo "hello";
      // $user = \App\User::find((int)$id)->usermongo; //not working needs some explanation in one direction
      //$user=\App\UserMongo::find((int)$id)->user;
      $user=\App\UserMongo::find((int)$id);
      // \Debugbar::info($user);
      echo $user->gender;

      foreach ($user->students as $student) {

        \Debugbar::info($student);
    //
        }
      // print_r($user);
    }

}
