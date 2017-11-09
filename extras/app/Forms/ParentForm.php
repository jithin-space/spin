<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ParentForm extends Form
{
    public function buildForm()
    {
      $tags=\App\Vocabulary::find(6)->terms;
      $a=[];
      foreach($tags as $tag)
      {
        $a['occupation'][$tag->id.'|'.$tag->name]=$tag->name;
      }
      $this->add('first_name','text',['rules' => 'required']);
      $this->add('last_name','text',['rules' => 'required']);
      $this->add('occupation', 'select', [
          'choices' => $a,
          'attr'=>[],
      ]);
      $this->add('relationship','select',[
        'choices'=>['relationships' => ['Father' => 'Father', 'Mother' => 'Mother', 'Other' => 'Other']],
        'attr'=>[],
      ]);
      $this->add('status','select',[
        'choices'=>['status' => ['Active' => 'Active', 'Inactive' => 'Inactive']],
        'attr'=>[],
      ]);
      $this->add('Address','form',[
        'class'=>'\App\Forms\AddressForm'
      ]);
      $this->add('email','text',[
        'rules'=>'Email|required'
      ]);


    }
}
