<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MedicationInfoForm extends Form
{
    public function buildForm()
    {
      $this->add('MedicationName','text',['rules'=>'required']);
      $this->add('DoctorName','text',['rules'=>'required']);
      $this->add('status','select',[
        'choices'=>['status' => ['Active' => 'Active', 'Inactive' => 'Inactive']],
        'attr'=>[],
        'rules'=>'required'
      ]);
      $this->add('remarks','textarea',[ ]);

    }
}
