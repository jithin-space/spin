<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'Vocabularies';
    public function terms()
    {
      return $this->belongsToMany('\App\Term');
    }
}
