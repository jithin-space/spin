<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class StrengthInfoForm extends Form
{
    public function buildForm()
    {
        //three child forms and one select field
        $this->add('type','select',[
          'choices'=>['info_type' => ['Strength' => 'Strength', 'Weakness' => 'Weakness', 'Special_Interests' => 'Special_Interests']],
          'attr'=>['class'=>'selector'],
          'empty_value' => '=== Select Any Option ===',
          'rules'=>'required',
        ]);
        $this->add('strength', 'collection', [
                   'type' => 'form',
                   'options' => [
                       'class' => 'App\Forms\StrengthForm',

                   ]
               ]);
        $this->add('weakness', 'collection', [
                          'type' => 'form',
                          'options' => [
                              'class' => 'App\Forms\WeaknessForm',
                          ]
                      ]);
          $this->add('special_interests', 'collection', [
                                        'type' => 'form',
                                        'options' => [
                                            'class' => 'App\Forms\SpecialInterestsForm',
                                        ]
                                    ]);



    }
}
