<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $guarded = [];
    public function users()
    {
      return $this->belongsToMany('\App\User');
    }
    public function subroles()
    {
        return $this->belongsToMany('\App\Term');
    }
}

?>
