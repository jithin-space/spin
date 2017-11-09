<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AttendanceForm extends Form
{
    public function buildForm()
    {
      $this->add('type','select',[
        'choices'=>['attendancetype' => ['Regular' => 'Regular', 'Special' => 'Special']],
        'attr'=>[],
      ]);
      $this->add('slot','select',[
        'choices'=>['attendanceslot'=>['slot1'=>'slot1','slot2'=>'slot2','slot3'=>'slot3','slot4'=>'slot4']],
        'attr'=>[],
      ]);
    }
}
