<?php

namespace App\Http\Controllers;

use App\Http\Service\UploadFile;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:teacher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $lessons = Lesson::where('course_id', $id)->get();
        return view('teachers.lessons.index', compact('lessons', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        return view('teachers.lessons.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uploadFile = new UploadFile();
        request()->validate([
            'theme' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
            'video' => 'required|mimes:mp4,avi,mov',
            'task' => 'required|mimes:pdf,doc,docx',
        ]);
        $file = $request->file('file');
        $video = $request->file('video');
        $task = $request->file('task');

        $file_name = $uploadFile->uploadFile($file, 'uploads/files');
        $video_name = $uploadFile->uploadFile($video, 'uploads/videos');
        $task_name = $uploadFile->uploadFile($task, 'uploads/tasks');

        $lesson = new Lesson();
        $lesson->theme = $request->theme;
        $lesson->course_id = $request->course_id;
        $lesson->file = $file_name;
        $lesson->video = $video_name;
        $lesson->task = $task_name;
        $lesson->save();
        return redirect()->route('lessons.index', ['id' => $request->course_id])
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('teachers.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $uploadFile = new UploadFile();
        request()->validate([
            'theme' => 'required',
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
            'video' => 'mimes:mp4,avi,mov',
            'task' => 'mimes:pdf,doc,docx',
        ]);
        $file = $request->file('file');
        $video = $request->file('video');
        $task = $request->file('task');
        if ($file) {
            $file_name = $uploadFile->uploadFile($file, 'uploads/files');
            $file_path = public_path('uploads/files/' . $lesson->file);
            $uploadFile->deleteFile($file_path);
            $lesson->file = $file_name;
        }
        if ($video) {
            $video_name = $uploadFile->uploadFile($video, 'uploads/videos');
            $video_path = public_path('uploads/videos/' . $lesson->video);
            $uploadFile->deleteFile($video_path);
            $lesson->video = $video_name;
        }
        if ($task) {
            $task_name = $uploadFile->uploadFile($task, 'uploads/tasks');
            $task_path = public_path('uploads/tasks/' . $lesson->task);
            $uploadFile->deleteFile($task_path);
            $lesson->task = $task_name;
        }
        $lesson->theme = $request->theme;
        $lesson->save();
        return redirect()->route('lessons.index', ['id' => $lesson->course_id])
            ->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $deleteFile = new UploadFile();
        $file_path = public_path('uploads/files/' . $lesson->file);
        $video_path = public_path('uploads/videos/' . $lesson->video);
        $task_path = public_path('uploads/tasks/' . $lesson->task);
        $deleteFile->deleteFile($file_path);
        $deleteFile->deleteFile($video_path);
        $deleteFile->deleteFile($task_path);
        $lesson->delete();
        return redirect()->route('lessons.index', ['id' => $lesson->course_id])
            ->with('success', 'Lesson deleted successfully.');
    }
}
