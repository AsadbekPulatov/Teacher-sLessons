<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Score;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher')->only('index', 'create', 'store', 'edit', 'update', 'destroy', 'import');
        $this->middleware('role:student')->only('run');
    }

    public function index(Request $request)
    {
        $id = $request->id;
        $lessons = Question::where('course_id', $id)->get();
        return view('teachers.tests.index', compact('lessons', 'id'));
    }

    public function create(Request $request)
    {
        $id = $request->id;
        return view('teachers.tests.create', compact('id'));
    }

    public function store(Request $request)
    {
        $user_id = auth()->id();

        $question = new Question();
        $question->question = $request['question'];
        $question->course_id = $request['course_id'];
        $question->user_id = $user_id;
        $question->save();

        $question_id = $question->id;
        $answers = $request['answer'];
        $data = [];
        foreach ($answers as $key => $item) {
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

    public function edit(Question $test)
    {
        return view('teachers.tests.edit', compact('test'));
    }

    public function update(Request $request, Question $test)
    {
        $test->question = $request['question'];
        $test->save();

        $answers = $test->answers;
        foreach ($request['answer'] as $key => $item) {
            $answers[$key]->answer = $item;
            $answers[$key]->question_id = $test->id;
            $answers[$key]->is_correct = $request['currect'] == $key ? 1 : 0;
            $answers[$key]->save();
        }
        return redirect()->route('tests.index', ['id' => $test->course_id]);
    }

    public function destroy(Question $test)
    {
        $id = $test->course_id;
        $test->delete();
        Alert::success('Success', __('messages.test_deleted'));
        return redirect()->route('tests.index', ['id' => $id]);
    }

    public function run($id)
    {
        $course = $id;
        $lessons = Lesson::where('course_id', $course)->get();
        $lesson_count = count($lessons);
        $lesson_ids = [];
        foreach ($lessons as $lesson)
            array_push($lesson_ids, $lesson->id);

        $tasks = Task::where('student_id', auth()->user()->id)->whereIn('lesson_id', $lesson_ids)->where('baho', '>=', 60)->get();
        $tasks_count = count($tasks);
        if ($lesson_count != $tasks_count) {
            Alert::error('Error', __("messages.sertificate_error"));
            return redirect()->back();
        }

        $questions = Question::where('course_id', $id)->get();
        $new_questions = [];
        foreach ($questions as $question) {
            $new_questions[$question->id]['question'] = $question->question;
            foreach ($question->answers as $answer) {
                $new_questions[$question->id]['answers'][] = [
                    'text' => $answer->answer,
                    'correct' => $answer->is_correct == 1 ? true : false,
                ];
            }
        }
        $new_questions = array_values($new_questions);
        $questions = json_encode($new_questions);
        $course = Course::findorfail($course);
        return view('students.test', compact('questions', 'course'));
    }

    public function import(Request $request)
    {
        $json = json_encode(file_get_contents($request->file), true);
        $text = json_decode($json);
        $user_id = auth()->id();
        $course_id = $request['course_id'];
        $data = explode("-----\r\n", $text);

        foreach ($data as $key => $item) {
            $values = explode("\r\n", $item);
            $question[] = $values[0];
            $answers[$key][] = substr($values[1], 3);
            $answers[$key][] = substr($values[2], 3);
            $answers[$key][] = substr($values[3], 3);
            $answers[$key][] = substr($values[4], 3);
            switch (substr($values[5], 8)) {
                case "A" :
                    $correct[] = 0;
                    break;
                case "B" :
                    $correct[] = 1;
                    break;
                case "C" :
                    $correct[] = 2;
                    break;
                case "D" :
                    $correct[] = 3;
                    break;
            }
        }

        $data_ans = [];
        foreach ($question as $key => $item) {
            $q = new Question();
            $q->question = $item;
            $q->user_id = $user_id;
            $q->course_id = $course_id;
            $q->save();


            foreach ($answers[$key] as $kk => $val)
                $data_ans[] = [
                    'answer' => $val,
                    'question_id' => $q->id,
                    'is_correct' => $correct[$key] == $kk ? 1 : 0,
                ];
        }

        Answer::insert($data_ans);
        Alert::success('Success', __('messages.test_created'));
        return redirect()->route('tests.index', ['id' => $course_id]);
    }

    public function result(Request $request){
        $score = new Score();
        $score->user_id = $request['user_id'];
        $score->course_id = $request['course_id'];
        $score->score = $request['score'];
        $score->save();

        return redirect()->route('my-courses');
    }

    public function show_result(Request $request, $course_id)
    {
        $scores = Score::orderby('id', 'DESC')->where('user_id', $request->student_id)->get();
        return view('teachers.tests.show', [
            'scores' => $scores,
        ]);
    }
}
