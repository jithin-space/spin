<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;


// class GoalAreaForm extends Form
// {
//     public function buildForm()
//     {
//         $this
//             ->add('goal_area_name', 'text')
//             ->add('goal_area_des', 'textarea');
//     }
// }
//
// class IepForm extends Form
// {
//   public function buildForm()
//   {
//       $this
//           ->add('id', 'text')
//           ->add('name', 'text')
//           ->add('goal_area', 'collection', [
//               'type' => 'form',
//               'options' => [
//                   'class' => 'App\Forms\GoalAreaForm',
//                   'label' => false,
//               ]
//             }
//           ]);
// }
class IepForm extends Form
{
  public function buildForm()
    {
        
        $this->add('goal_area', 'text');
        $this->add('long_term_objective', 'text');
        $this->add('description','text');
      }

}
