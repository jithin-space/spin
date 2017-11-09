<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Debugbar;
use Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class RoleController extends Controller
{
    //
      use FormBuilderTrait;
    public function __construct()
    {
       $this->middleware('role:admin', ['except' => ['index', 'show']]);
    }
    public function index()
    {

        return view('admins.roles.index')
          ->with('roles',\App\Role::all());

    }
    public function create()
    {

      $form = $this->form(\App\Forms\RoleForm::class, [
        'method' => 'POST',
        'route' => array('roles.store',\Auth::user()->roles()->first()->name),
    ]);
      return view('admins.roles.create',compact('form'));

    }
    // public function edit($id)
    // {
    //           $role=\App\Role::find($id);
    //           // $assigned=$role->user_ids;
    //           $ids=array();
    //           foreach($role->users as $user)
    //           {
    //             array_push($ids,(int)$user->id);
    //           }
    //           // $assigned=is_null($assigned)?[]:$assigned;
    //           $users=\App\User::whereNotIn('id',$ids)->get();
    //           $data=array('users'=>$users,'role'=>$role);
    //           return view('admins.roles.edit')
    //             ->with('data',$data );
    //
    // }

    // public function update($_id)
    // {
    //    $ar=array();
    //    $id=is_null(Request::input('id'))?[]:Request::input('id');
    //    foreach($id as $i):
    //     array_push($ar,(int)$i);
    //    endforeach;
    //    \App\Role::find($_id)->users()->attach($ar);
    //    return redirect()->route('roles.index')
    //        ->withSuccess("successfully updated roles details");
    // }

    // public function destroy($id)
    // {
    //   $u_id=(int)$id;
    //   $r_id=(int)Request::input('sid');
    //   \App\Role::find($r_id)->users()->detach($u_id);
    //     return redirect()->route('roles.index')
    //         ->withSuccess('successfully removed the role');
    // }

    public function edit(\App\Role $role)
    {


              $form = $this->form(\App\Forms\RoleForm::class, [
                  'method' => 'POST',
                  'route' => array('roles.update',\Auth::user()->roles()->first()->name,$role->id),
                  'model' => $role
              ]);
                return view('admins.roles.edit',compact('form'));

    }

    public function update(\App\Role $role)
    {
        $form=$this->form(\App\Forms\RoleForm::class);
        $form->validate(['name'=>'required|unique:roles,name,'.$role->id.',id|min:4','display_name'=>'required|unique:roles,display_name,'.$role->id.',id','description'=>'required']);
        if(!$form->isValid())
        {
           return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        \App\Role::where('id', $role->id)->update($form->getFieldValues());
        return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
            ->withSuccess("successfully updated permission details");
    }

    public function store(Request $request)
    {

      $form = $this->form(\App\Forms\RoleForm::class);
        $form->validate(['name'=>'required|unique:roles|min:4','display_name'=>'required|unique:roles','description'=>'required']);
       if (!$form->isValid()) {
           return redirect()->back()->withErrors($form->getErrors())->withInput();
       }


        \App\Role::create($form->getFieldValues());
         return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
               ->withSuccess('successfully created a new role');



    }

    public function destroy(\App\Role $role)
    {

      $users=$role->users;
      $def=\App\Role::where('name','=','Default')->firstOrFail();
      foreach($users as $user){
        $user->roles()->detach();
        $user->subroles()->detach();
        $user->roles()->attach($def->id);
      }
      $subroles=$role->subroles;
      $role->subroles()->detach();
      foreach($subroles as $subrole)
      {
        $subrole->delete();
      }


        $role->delete();
        return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
            ->withSuccess('successfully deleted the role');
    }
}
