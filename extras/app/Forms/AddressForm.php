<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AddressForm extends Form
{
  public function buildform()
  {
    $this->add('Line1','text');
    $this->add('Line2','text');
    $this->add('City', 'text');
    $this->add('Country','select',
    [
      'attr'=>['class'=>'form-control bfh-countries','id'=>'countries_phone1','data-country'=>'IN']
    ]);
    $this->add('State', 'select',[
      'attr'=>['class'=>'form-control bfh-states','data-country'=>'countries_phone1'],
      'rules'=>'required'
    ]);
    $this->add('PostCode','number');
    $this->add('Land_Phone','text',[
      'attr'=>['class'=>'form-control bfh-phone','data-country'=>'countries_phone1']
    ]);
    $this->add('Mobile_Number','text',[
    ]);

  }
}
