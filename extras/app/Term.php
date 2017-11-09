<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
  protected $guarded = [];
  public function vocabularies()
  {
    return $this->belongsToMany('\App\Vocabulary');
  }

  public function students()
  {
    return $this->belongsToMany('\App\Student',null,'term_ids','student_ids');
  }

  public function main_role()
  {
    return $this->belongsToMany('\App\Role');
  }

  public function main_user()
  {
    return $this->belongsToMany('\App\User');
  }
}

?>
