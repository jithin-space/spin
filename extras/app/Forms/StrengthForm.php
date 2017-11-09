<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class StrengthForm extends Form
{
    public function buildForm()
    {
        $this->add('name','text',['rules'=>'required']);
        $this->add('strength_type','select',[
          'choices'=>['strength_type' => ['Already_Had' => 'Already_Had', 'Acheived_At_Insight' => 'Acheived_At_Insight', 'Need_To_Acheive' => 'Need_To_Acheive','Other'=>'Other']],
          'attr'=>[],
          'empty_value' => '=== Select Any Option ==='
        ]);
        $this->add('description','text',['rules'=>'required']);
        $this->add('remarks','textarea');

    }

}
