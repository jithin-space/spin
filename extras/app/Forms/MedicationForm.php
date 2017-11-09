<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MedicationForm extends Form
{
    public function buildForm()
    {
      // $tags=\App\Vocabulary::find(6)->terms;
      // $a=[];
      // foreach($tags as $tag)
      // {
      //   $a['occupation'][$tag->id.'|'.$tag->name]=$tag->name;
      // }
      $this->add('MedicationName','text',['rules'=>'required']);
      $this->add('DoctorName','text');
      $this->add('status','select',[
        'choices'=>['status' => ['Active' => 'Active', 'Inactive' => 'Inactive']],
        'attr'=>[],
      ]);
      $this->add('remarks','textarea',[ ]);
      $this->add('start_date','text',['template'=>'forms.date','attr'=>'']);
      $this->add('end_date','text');

    }
}
