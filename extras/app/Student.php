<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Plank\Mediable\Mediable;
class Student extends Eloquent
{
	use Mediable;
	protected $connection='mongodb';
  protected $collection='students';
	// protected $primaryKey='id';
	public function ieps()
	{
		 return $this->embedsMany('App\IEP');
	}
	public function support_team()
    {
        return $this->belongsToMany('App\UserMongo',null,'student_ids','user_ids');
    }

	public function feedbacks()
		{
			return $this->embedsMany('\App\Feedback');
		}
	public function attendances()
	{
		return $this->embedsMany('\App\Attendance');
	}
	public function disabilities()
		{
			return $this->belongsToMany('\App\Term', null,'student_ids','term_ids');
		}
}
