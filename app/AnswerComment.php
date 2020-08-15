<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    //
    protected $table =  "answers_comments";
    protected $fillable = [
        'isi_comments', 'answers_id', 'users_id',
    ];

    public function answer() {
		return $this->belongsTo('App\Answer', 'answers_id');
	}

    public function user() {
		return $this->belongsTo('App\User', 'users_id');
	}
}
