<?php

namespace App\Http\Controllers\panel;

use App\Models\QuestionAndAnswer;
use App\Http\Requests\QuestionAndAnswerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class QuestionAndAnswerController extends Controller
{
    /**
     * Display a listing of the QuestionAndAnswers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.question_and_answer', [
            'question_and_answers' => QuestionAndAnswer::latest()->get(),
            'page_name' => 'question_and_answer',
            'page_title' => 'ثبت پرسش و پاسخ',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new QuestionAndAnswer.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /**
     * Store a newly created question_and_answer in storage.
     *
     * @param  \App\Http\Requests\QuestionAndAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        QuestionAndAnswer::create(array_merge($request -> all(), [
            'photo' => Input::file('photo') ? $this->upload_image( Input::file('photo') ) : null,
        ]));
        return redirect()->back()->with('message', "پرسش و پاسخ {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified question_and_answer.
     *
     * @param  \App\QuestionAndAnswer  $question_and_answer
     * @return \Illuminate\Http\Response
     * 
     * public function show(QuestionAndAnswer $question_and_answer)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified question_and_answer.
     *
     * @param  \App\QuestionAndAnswer  $question_and_answer
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionAndAnswer $question_and_answer)
    {
        return view('panel.question_and_answer', [
            'question_and_answers' => QuestionAndAnswer::latest()->get(),
            'question_and_answer' => $question_and_answer,
            'page_name' => 'question_and_answer',
            'page_title' => "ویرایش پرسش و پاسخ {$question_and_answer->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified question_and_answer in storage.
     *
     * @param  \App\Http\Requests\QuestionAndAnswerRequest  $request
     * @param  \App\QuestionAndAnswer  $question_and_answer
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionAndAnswerRequest $request, QuestionAndAnswer $question_and_answer)
    {
        if ($request->hasFile('photo'))
        {
            $photo = $this->upload_image( Input::file('photo') );
            
            if ( file_exists( public_path($question_and_answer->photo) ) )
                unlink( public_path($question_and_answer->photo) );
        }
        else
        {
            $photo = $question_and_answer->icon;
        }
        $question_and_answer->update(array_merge($request -> all(), [ 'photo' => $photo ]));
        return redirect()->back()->with('message', "پرسش و پاسخ {$question_and_answer->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified question_and_answer from storage.
     *
     * @param  \App\QuestionAndAnswer  $question_and_answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionAndAnswer $question_and_answer)
    {
        $question_and_answer->delete();
        return redirect( route('question_and_answer.index') )->with('message', "پرسش و پاسخ {$question_and_answer->title} با موفقیت حذف شد");
    }
}
