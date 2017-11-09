<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class StudentForm extends Form
{
    public function buildForm()
    {
        $this->add('fname','text',['rules' => 'required|min:3']);
        $this->add('lname','text',['rules' => 'required|min:1']);
        $this->add('student_id','number');
        $this->add('profile','file');

    }
}
