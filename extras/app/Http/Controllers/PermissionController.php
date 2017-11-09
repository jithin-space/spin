<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use Debugbar;
use Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;


class PermissionController extends Controller
{
  use FormBuilderTrait;
  public function __construct()
  {
     $this->middleware('role:admin', ['except' => ['index', 'show']]);
  }
  public function index()
  {
      return view('admins.permissions.index')
        ->with('permissions',\App\Permission::all());

  }

  public function create()
  {
    $form = $this->form(\App\Forms\PermissionForm::class, [
      'method' => 'POST',
      'route' => array('permissions.store',\Auth::user()->roles()->first()->name),
  ]);
    return view('admins.permissions.create',compact('form'));
  // return "hellooooo";
  }

  public function edit($id)
  {

            $per=\App\Permission::find($id);
            \Debugbar::info($per);

              $form = $this->form(\App\Forms\PermissionForm::class, [
                'method' => 'POST',
                'route' => array('permissions.update',\Auth::user()->roles()->first()->name,$id),
                'model' => $per
            ]);
              return view('admins.permissions.edit',compact('form'));

  }
  public function store(Request $request)
  {

    $form = $this->form(\App\Forms\PermissionForm::class);
    $form = $this->form(\App\Forms\RoleForm::class);
      $form->validate(['name'=>'required|unique:permissions|min:4','display_name'=>'required|unique:permissions','description'=>'required']);
     if (!$form->isValid()) {
         return redirect()->back()->withErrors($form->getErrors())->withInput();
     }
       $out=\App\Permission::create($form->getFieldValues());
       return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
             ->withSuccess('successfully created a new permission');
  }
  public function update($id)
  {
      $form=$this->form(\App\Forms\PermissionForm::class);
      $form->validate(['name'=>'required|unique:permissions,name,'.$id.',id|min:4','display_name'=>'required|unique:permissions,display_name,'.$id.',id','description'=>'required']);
      if(!$form->isValid())
      {
         return redirect()->back()->withErrors($form->getErrors())->withInput();
      }
      \App\Permission::where('id', $id)->update($form->getFieldValues());
      return redirect()->route('permissions.index',\Auth::user()->roles()->first()->name)
          ->withSuccess("successfully updated permission details");
  }
  public function destroy($id)
  {
      \App\Permission::destroy($id);
      return redirect()->route('permissions.index')
          ->withSuccess('successfully deleted the permission');
  }

}
