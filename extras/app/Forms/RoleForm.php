<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RoleForm extends Form
{
    public function buildForm()
    {
      $this->add('name','text');
      $this->add('display_name','text');
      $this->add('description','text');
    }
}
