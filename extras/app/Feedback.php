<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Feedback extends Eloquent
{
    //
    protected $connection='mongodb';

    public function comments()
  	{
  		 return $this->embedsMany('App\Comment');
  	}

}

?>
