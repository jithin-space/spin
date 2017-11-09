<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usermongo()
    {
      return $this->hasOne('\App\UserMongo','id','id');
    }

    public function roles()
    {
      return $this->belongsToMany('\App\Role');
    }

    public function subroles()
    {
      return $this->belongsToMany('\App\Term');
    }


}
