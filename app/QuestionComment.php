<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    //
    protected $table =  "questions_comments";
    protected $fillable = [
        'isi_comments','questions_id', 'users_id',
    ];

    public function user() {
		return $this->belongsTo('App\User', 'users_id');
	}
}
