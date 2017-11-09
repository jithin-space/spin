<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class OtherServicesForm extends Form
{
    public function buildForm()
    {
      $tags=\App\Vocabulary::find(8)->terms;
      $a=[];
      foreach($tags as $tag)
      {
        $a['services'][$tag->id.'|'.$tag->name]=$tag->name;
      }
      $this->add('service_category', 'select', [
          'choices' => $a,
          'attr'=>[],
      ]);
      $this->add('service_type','select',[
        'choices'=>['types' => ['External' => 'External', 'Internal' => 'Internal', 'Other' => 'Other']],
        'attr'=>[],
      ]);
        $this->add('attachments','file',[
          'attr'=>['class' => 'filestyle','multiple'=>'multiple','name'=>'attachments[]']
        ]);
        $this->add('service_status','select',[
          'choices'=>['status' => ['OnGoing' => 'OnGoing', 'Completed' => 'Completed', 'Terminated' => 'Terminated']],
          'attr'=>[],
        ]);
        $this->add('description','textarea',['rules'=>'required']);

    }
}
