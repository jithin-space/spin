<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{

    public function buildForm()
    {
        $this->add('name','text');
        $this->add('email','email');

      


    }

}
