<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class WeaknessForm extends Form
{
    public function buildForm()
    {
      $this->add('name','text',['rules'=>'required']);
      $this->add('weakness_type','select',[
        'choices'=>['weakness_type' => ['Motion' => 'Motion', 'Communication' => 'Communication', 'Concentration' => 'Concentration','Other'=>'Other']],
        'attr'=>[],
        'empty_value' => '=== Select Any Option ==='
      ]);
      $this->add('description','text',['rules'=>'required']);
      $this->add('remarks','textarea');
    }
}
