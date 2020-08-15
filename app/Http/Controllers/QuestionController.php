<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use App\Tag;
use App\User;
use App\Vote;
use App\QuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::orderBy('created_at', 'desc')->get();
        return view('question.index',compact('question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->all();
        //dd($request->all());
        $newAsk = Question::create([
            "judul" => $request->judul,
            "isi_pertanyaan" => $request->isi_pertanyaan,
            "users_id" => $request->user_id,
        ]);
        $tagArr = explode(",", $request->tags);
        $tagMulti = [];
        foreach ($tagArr as $strtag) {
         $tagAssc["tags"] = $strtag;
         $tagMulti[] = $tagAssc;
        } 

        foreach ($tagMulti as $tagCek) {
            $tag = Tag::firstOrCreate($tagCek);
            $newAsk->tags()->attach($tag->id);
        }

        return redirect('/questions');
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $answers = Answer::getAnswerById($question['id']);
        // $count = $answers->count();
        // dd($count);
        $ask = Question::find($question->id);
        // dd($ask->user->name);
        return view('question.detail', compact('ask'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        Question::find($question);
        //dd($question->tags);
        return view('question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        $data = $request->all();
        //dd($data, $data2);
        $question->update([
            "judul" => $request->judul,
            "isi_pertanyaan" => $request->isi_pertanyaan,
            "users_id" => $request->users_id
        ]);
        $question->tags()->detach();
        $tagArr = explode(",", $request->tags);
        $tagMulti = [];
        foreach ($tagArr as $strtag){
         $tagAssc["tags"] = $strtag;
         $tagMulti[] = $tagAssc;
        } 
        foreach ($tagMulti as $tagCek) {
            $tag = Tag::updateOrCreate($tagCek);
            $question->tags()->attach($tag->id);
        }
        // dd($question);
        unset($data['_token'], $data['_method'],$data['tags']);
        return redirect('/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        QuestionModel::delete($id);
        return redirect('/questions');
    }

    public function questionVote(Request $request) {
        $question_id = $request['questionId'];
        $is_vote = $request['isVote'] === 'true';
        $update = false;
        $question = Question::find($question_id);
        if (!$question) {
            return null;
        }
        $user = Auth::user();
        $vote = $user->vote()->where('questions_id', $question_id)->first();
        if ($vote) {
            $already_vote = $vote->vote;
            $update = true;
            if ($already_vote == $is_vote) {
                $vote->delete();
                return null;
            }
        } else {
            $vote = new Vote();
        }
        $vote->vote = $is_vote;
        $vote->users_id = $user->id;
        $vote->questions_id = $question->id;
        if ($update) {
            $vote->update();
        } else {
            $vote->save();
        }
        return null;
    }
}
