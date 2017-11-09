<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserMongo extends Eloquent
{
	protected $connection='mongodb';
  protected $collection='users_mongo';
  protected $primaryKey='id';

  public function user()
   {
       return $this->belongsTo('App\User','id','id');
   }

	 public function students()
     {
         return $this->belongsToMany('App\Student',null,'user_ids','student_ids');
     }

	
}
