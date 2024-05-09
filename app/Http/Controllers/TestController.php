<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher')->only('index');
    }

    public function index(Request $request){
        $id = $request->id;
        $lessons = Question::where('course_id', $id)->get();
        return view('teachers.tests.index', compact('lessons', 'id'));
    }

    public function create(Request $request){
        $id = $request->id;
        return view('teachers.tests.create', compact('id'));
    }

    public function store(Request $request){
        $user_id = auth()->id();

        $question = new Question();
        $question->question = $request['question'];
        $question->course_id = $request['course_id'];
        $question->user_id = $user_id;
        $question->save();

        $question_id = $question->id;
        $answers = $request['answer'];
        $data = [];
        foreach ($answers as $key => $item){
            $data[] = [
                'answer' => $item,
                'question_id' => $question_id,
                'is_correct' => $request['currect'] == $key ? 1 : 0,
            ];
        }
        Answer::insert($data);
        Alert::success('Success', __('messages.test_created'));
        return redirect()->route('tests.index', ['id' => $request->course_id]);
    }

    public function edit(Question $test){
        return view('teachers.tests.edit', compact('test'));
    }

    public function update(Request $request, Question $test){
        $test->question = $request['question'];
        $test->save();

        $answers = $test->answers;
        foreach ($request['answer'] as $key => $item){
            $answers[$key]->answer = $item;
            $answers[$key]->question_id = $test->id;
            $answers[$key]->is_correct = $request['currect'] == $key ? 1 : 0;
            $answers[$key]->save();
        }
        return redirect()->route('tests.index', ['id' => $test->course_id]);
    }

    public function destroy(Question $test){
        $id = $test->course_id;
        $test->delete();
        Alert::success('Success', __('messages.test_deleted'));
        return redirect()->route('tests.index', ['id' => $id]);
    }
}
