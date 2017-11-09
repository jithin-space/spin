<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class VocabularyForm extends Form
{
    public function buildForm()
    {
      $this->add('name','text',['rules' => 'required|min:5']);
      $this->add('description','text',['rules' => 'required|min:5']);
    }
}
