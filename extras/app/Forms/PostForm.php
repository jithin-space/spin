<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;


class TagsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('desc', 'textarea');
    }
}

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('body', 'textarea')
            ->add('tags', 'collection', [
                'type' => 'form',
                'options' => [    
                    'class' => 'App\Forms\TagsForm',
                    'label' => false,
                ]
            ]);
    }
}
