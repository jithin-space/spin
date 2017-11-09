<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests;

class TermController extends Controller
{
  use FormBuilderTrait;
  public function create()
  {
    $form = $this->form(\App\Forms\TermForm::class, [
      'method' => 'POST',
      'route' => 'terms.store'
    ]);
    return view('all.terms.create',compact('form'));
  }

  public function store()
  {
    $term=new \App\Term;
    $term->name=Input::get("name");
    $term->parent=0;
    $term->weight=0;
    $term->save();
    $term->vocabularies()->attach(Input::get("voc"));

    return redirect(url()->previous())
          ->withSuccess('successfully created a new long term objective');
  }


}
