<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MediaGalleryForm extends Form
{
    public function buildForm()
    {
      $this->add('media_type','select',[
        'choices'=>['types' => ['Images' => 'Images', 'Videos' => 'Videos', 'Documents' => 'Documents','Other'=>'Other']],
        'attr'=>[],
      ]);
      $this->add('gallery','file',[
        'attr'=>['class' => 'filestyle','multiple'=>'multiple','name'=>'gallery[]']
      ]);
    }
}
