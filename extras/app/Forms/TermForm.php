<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TermForm extends Form
{
    public function buildForm()
    {
      $this->add('name','text',['rules' => 'required|min:5']);
      $this->add('description','text',['rules' => 'required|min:5']);
    }
}
