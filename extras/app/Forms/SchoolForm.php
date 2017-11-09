<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SchoolForm extends Form
{
    public function buildForm()
    {
      $tags=\App\Vocabulary::find(7)->terms;
      $a=[];
      foreach($tags as $tag)
      {
        $a['school_type'][$tag->id.'|'.$tag->name]=$tag->name;
      }
      $this->add('school_name','text',['rules'=>'required']);
      $this->add('school_type', 'select', [
          'choices' => $a,
          'attr'=>[],
      ]);
      $this->add('status','select',[
        'choices'=>['status' => ['OnGoing' => 'OnGoing', 'Completed' => 'Completed']],
        'attr'=>[],
      ]);
      $this->add('Address','form',[
        'class'=>'\App\Forms\AddressForm'
      ]);
      $this->add('Year_Of_Joining','text');
      $this->add('Year_Of_Completion','text');
      $this->add('email','text',[
        'rules'=>'Email|required'
      ]);

    }
}
