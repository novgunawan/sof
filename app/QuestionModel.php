<?php

namespace App;
use Illuminate\Support\Facades\DB;

class QuestionModel {
	public static function update($data){
		$update_data = DB::table('questions')
		->where('id',$data['id'])
		->update($data);
		return $update_data;
	}

	public static function delete($id){
		$delete = DB::table('questions')
		->where('id',$id)
		->delete();
	}
}   
?>