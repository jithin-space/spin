<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ProfileForm extends Form
{
    public function buildForm()
    {
        // Add fields here...

        $this->add('Address','form',[
          'class'=>'\App\Forms\AddressForm'
        ]);
    }
}
