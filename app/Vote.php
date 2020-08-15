<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
	protected $table = 'vote';

	public function user() {
		return $this->belongsTo('App\User', 'users_id');
	}

	public function question() {
		return $this->belongsTo('App\Question', 'questions_id');
	}
}
