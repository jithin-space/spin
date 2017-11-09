<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Plank\Mediable\Media;
use App\Services\IepService;
use Illuminate\Support\Facades\Input;
use Debugbar;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class ProfileController extends Controller
{

 use FormBuilderTrait;
  public function index()
  {
    return view('all.profiles.home');
  }

  public function show($id)
  {
    $user=\App\UserMongo::find((int)$id);
    return view('all.profiles.home')
    ->with('user',$user);
  }
  public function create()
  {

    $form = $this->form(\App\Forms\ProfileForm::class, [
      'method' => 'POST',
      'route' => array('profile.store'),
      ]);
    $form->add('Name','text',['attr'=>['disabled'],'value'=> \Auth::user()->name]);
    $form->add('email','text',['rules'=>'Email|required','attr'=>['disabled'],'value'=>\Auth::user()->email]);

    return view('all.profiles.create',compact('form'));
  }

  public function store()
  {

    $user=\App\UserMongo::find((int)\Auth::user()->id);
    $a=[];
    $a['date_of_birth']=Input::get('date_of_birth');
    $a['date_of_joining']=Input::get('date_of_joining');
    $a['gender']=Input::get('gender');
    $a['Address']=Input::get('Address');
    $user->profile_info=$a;
    $user->save();
    return redirect()->route('profile.show',\Auth::user()->id)
    ->withSuccess("successfully added user details");

  }

  public function edit($id)
  {
    $user=\App\UserMongo::find((int)\Auth::user()->id);
    $form = $this->form(\App\Forms\ProfileForm::class, [
      'method' => 'POST',
      'route' => array('profile.update',1),
      'model'=> $user->profile_info,
      ]);
    $form->add('Name','text',['attr'=>['disabled'],'value'=> \Auth::user()->name]);
    $form->add('email','text',['rules'=>'Email|required','attr'=>['disabled'],'value'=>\Auth::user()->email]);

    return view('all.profiles.edit',compact('form','user'));

  }

  public function update($id)
  {

    $user=\App\UserMongo::find((int)\Auth::user()->id);
    $a=[];
    $a['date_of_birth']=Input::get('date_of_birth');
    $a['date_of_joining']=Input::get('date_of_joining');
    $a['gender']=Input::get('gender');
    $a['Address']=Input::get('Address');
    $user->profile_info=$a;
    $user->save();
    return redirect()->route('profile.show',\Auth::user()->id)
    ->withSuccess("successfully updated user details");


  }

  public function destroy($id)
  {

    $user=\App\UserMongo::find((int)\Auth::user()->id);

    $user->profile_info=[];
    $user->save();
    return redirect()->route('profile.show',\Auth::user()->id)
    ->withSuccess("successfully deleted student details");

  }
}
