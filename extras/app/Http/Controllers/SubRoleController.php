<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilderTrait;
class SubRoleController extends Controller
{

     use FormBuilderTrait;
    public function index()
    {
        //
    }


    public function create($id)
    {

        $form = $this->form(\App\Forms\TermForm::class, [
          'method' => 'POST',
          'route' => array('roles.subrole.store',\Auth::user()->roles()->first()->name,$id),
        ]);
        return view('all.subrole.create',compact('form'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //

         $voc=\App\Vocabulary::where('name','=','SubRoles')->firstOrFail();
          $form = $this->form(\App\Forms\TermForm::class);

          $form->validate(['name'=>'required|unique:terms']);
          if (!$form->isValid()) {
             return redirect()->back()->withErrors($form->getErrors())->withInput();
          }
          $term=new \App\Term;
          $term->name=Input::get("name");
          $term->parent= 0;
          $term->weight=0;
          $term->save();
          $term->vocabularies()->attach($voc->id);
          $role=\App\Role::find($id);
          $role->subroles()->attach($term->id);
          return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
              ->withSuccess("successfully updated subrole details");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rid,$sid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rid,$sid)
    {
      $term=\App\Term::find($sid);
      $form = $this->form(\App\Forms\TermForm::class, [
        'method' => 'POST',
        'route' => array('roles.subrole.update',\Auth::user()->roles()->first()->name,$rid,$sid),
        'model' => $term,
      ]);
      return view('all.terms.edit',compact('form','rid','sid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($rid,$sid)
    {
        //
        echo "entering";
        $term=\App\Term::find($sid);
        $form = $this->form(\App\Forms\TermForm::class);
        $form->validate(['name'=>'required|unique:terms,name,'.$sid.',id']);

        //$form->redirectIfNotValid();
        if (!$form->isValid()) {
           return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)->withErrors($form->getErrors())->withInput();
       }

        $term->update($form->getFieldValues());

        return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
            ->withSuccess("successfully updated subrole details");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rid,$sid)
    {
        echo "entering";
        $term=\App\Term::find($sid);
        $def=\App\Role::where('name','=','Default')->firstOrFail();
        $term->vocabularies()->detach();
        $term->main_role()->detach();
        foreach($term->main_user as $user)
        {
          $user->roles()->detach();
          $user->subroles()->detach();
          $user->roles()->attach($def->id);
        }
        $term->main_user()->detach();
        $term->delete();

        return redirect()->route('roles.index',\Auth::user()->roles()->first()->name)
            ->withSuccess("successfully deleted the subrole");

    }
}
