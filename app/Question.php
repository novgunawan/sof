<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = [];
    
    public function tags(){
    	return $this->belongsToMany('App\Tag','questions_tags','questions_id','tags_id');
    }

    public function answer() {
    return $this->hasMany('App\Answer','questions_id');
    }
    
    public function user(){
    	return $this->belongsTo('App\User','users_id');
    }

    public function askcomment(){
        return $this->hasMany('App\QuestionComment','questions_id');
    }

    public function vote(){
        return $this->belongsTo('App\Vote');
    }

}
