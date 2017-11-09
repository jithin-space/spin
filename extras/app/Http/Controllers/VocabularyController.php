<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class VocabularyController extends Controller
{
    //
    use FormBuilderTrait;
    public function show($id)
    {
      $voc=\App\Term::find($id)->parent;
      $ltos=\App\Vocabulary::find($voc)->terms;
      $datas=array('data'=>$ltos,'voc_id'=>$voc);
      return view('all.vocabulary.show')
         ->with('datas',$datas );
    }
    public function create()
    {
      // echo "hello";
      $form = $this->form(\App\Forms\VocabularyForm::class, [
        'method' => 'POST',
        'route' => 'vocabulary.store'
      ]);

      return view('all.vocabulary.create',compact('form'));
    }

    public function edit($id)
    {

      $form = $this->form(\App\Forms\TermForm::class, [
        'method' => 'POST',
        'route' => array('vocabulary.update',$id),
      ]);
      return view('all.vocabulary.edit',compact('form'));
    }
    public function update($id)
    {
        if($id==1)
        {
          $voc= new \App\Vocabulary;
          $voc->name=Input::get('name');
          $voc->save();
        }
          $form = $this->form(\App\Forms\TermForm::class);
          $term=new \App\Term;
          $term->name=Input::get("name");
          if(isset($voc->id))
          {$term->parent= $voc->id;}
          else {
            $term->parent= 0;
          }
          $term->weight=0;
          $term->save();
          $term->vocabularies()->attach($id);

          if($id==1)
          {
            $voc= new \App\Vocabulary;
            $voc->name=Input::get('name');
            $voc->save();
          }

          return redirect(url()->previous())
                ->withSuccess('successfully created a new term');
    }
    public function store()
    {
      echo Input::get('name');
      $voc= new \App\Vocabulary;
      $voc->name=Input::get('name');
      $voc->save();
      echo $voc->id;
      $term=new \App\Term;
      $term->name=$voc->name;
      $term->parent=$voc->id;
      $term->weight=0;
      $term->save();
      $voc=\App\Vocabulary::find(1);
      $voc->terms()->attach($term->id);

      return redirect(url()->previous())
            ->withSuccess('successfully created a new vocabulary');
    }
}
