<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SchoolInfoForm extends Form
{
  public function buildForm()
  {
    $this
        ->add('school', 'collection', [
               'type' => 'form',
               'options' => [
                   'class' => 'App\Forms\SchoolForm',
                   'label' => false,
               ]
           ]);
  }
}
