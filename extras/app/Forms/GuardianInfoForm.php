<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;



class GuardianInfoForm extends Form
{
    public function buildForm()
    {
      $this
          ->add('guardian', 'collection', [
                 'type' => 'form',
                 'options' => [
                     'class' => 'App\Forms\ParentForm',
                     'label' => false,
                 ]
             ]);
    }
}
