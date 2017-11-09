<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class BackgroundInfoForm extends Form
{


    public function buildForm()
    {

      $this
      
          ->add('tags', 'collection', [
                 'type' => 'form',
                 'options' => [
                     'class' => 'App\Forms\TagForm',
                     'label' => false,
                 ]
             ]);

    }
}
