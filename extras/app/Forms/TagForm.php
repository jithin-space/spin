<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TagForm extends Form
{

    public function buildForm()
    {
      $tags=\App\Vocabulary::find(5)->terms;
      $a=[];
      foreach($tags as $tag)
      {
        $a[$tag->id.'|'.$tag->name]=$tag->name;
      }

        $this->add('Info_Type', 'select', [
            'choices' => $a,
        ]);
         $this->add('Description','textarea',['rules' => 'required|min:5']);

    }
}
