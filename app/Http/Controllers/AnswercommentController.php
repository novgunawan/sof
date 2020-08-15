<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnswerComment;

class AnswercommentController extends Controller
{
    //
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'answers_id' => 'required',
            'isi_comments' => 'required',
            'users_id' => 'required'
        ]);
        $result = AnswerComment::create($request->all());
        return redirect()->back();
    }
}
