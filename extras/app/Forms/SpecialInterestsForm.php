<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SpecialInterestsForm extends Form
{
    public function buildForm()
    {

        $this->add('name','text',['rules'=>'required']);
        $this->add('interest_type','select',[
          'choices'=>['interest_type' => ['Music' => 'Music', 'Games' => 'Games', 'Reading' => 'Reading','Other'=>'Other']],
          'attr'=>[],
          'empty_value' => '=== Select Any Option ==='
        ]);
        $this->add('description','text',['rules'=>'required']);
        $this->add('remarks','textarea');
    }
}
