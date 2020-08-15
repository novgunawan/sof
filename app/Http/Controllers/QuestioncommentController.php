<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionComment;

class QuestioncommentController extends Controller
{
    //
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'isi_comments' => 'required',
            'questions_id' => 'required',
            'users_id' => 'required',
        ]);
        $result = QuestionComment::create($request->all());
        return redirect()->back();
    }
}
