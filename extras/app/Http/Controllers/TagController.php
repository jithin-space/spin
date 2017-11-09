<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class TagController extends Controller
{
    //
    use FormBuilderTrait;
    public function __construct()
    {
      $this->middleware('role:admin', ['except' => ['index', 'show']]);
    }

    public function index()
    {
      $vocs=\App\Vocabulary::paginate(5);

      return view('admins.tags.index')
        ->with('vocs',$vocs);
    }


    public function edit($id)
    {
      $vocabulary=\App\Vocabulary::find($id);

        $form = $this->form(\App\Forms\VocabularyForm::class, [
          'method' => 'POST',
          'route' => array('tags.update',$id),
          'model' => $vocabulary
      ]);
        return view('admins.tags.edit',compact('form'));
    }

    public function update($id)
    {
        $form=$this->form(\App\Forms\VocabularyForm::class);
        $vocabulary=\App\Vocabulary::find($id);
        $vocabulary->update($form->getFieldValues());

        return redirect()->route('tags.index')
        ->withSuccess("successfully updated vocabulary details");

    }

}
