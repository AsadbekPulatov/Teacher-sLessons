<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Score;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student')->only('course', 'courseDetail', 'courseStart', 'courseLessons', 'myCourses');
        $this->middleware('role:teacher')->only('studentStatus', 'students', 'studentStatus', 'studentDelete');
    }

    public function myCourses(Request $request)
    {
        $category = $request->get('category');
        $search = $request->get('search');
        if ($category) {
            $course = Course::where('category_id', $category)->pluck('id');
            $courses = Booking::with('course', 'teacher')->where('student_id', auth()->user()->id)->whereIn('course_id', $course)->paginate(6)->withQueryString();
        } else {
            $courses = Booking::with('course', 'teacher')->where('student_id', auth()->user()->id)->paginate(6)->withQueryString();
        }
        if ($search) {
            $course = Course::where('title', 'like', '%' . $search . '%')->pluck('id');
            $courses = Booking::with('course', 'teacher')->where('student_id', auth()->user()->id)->whereIn('course_id', $course)->paginate(6)->withQueryString();
        }
        $categories = Category::all();
        return view('students.my-courses', compact('courses', 'categories'));
    }

    public function course(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        if ($category) {
            $courses = Course::where('category_id', $category)->paginate(6)->withQueryString();
        } else {
            $courses = Course::paginate(6)->withQueryString();
        }
        if ($search) {
            $courses = Course::where('title', 'like', '%' . $search . '%')->paginate(6)->withQueryString();
        }
        $categories = Category::all();
        return view('students.course', compact('courses', 'categories'));
    }

    public function courseDetail($id)
    {
        $course = Course::with('lessons')->find($id);
        $course->views = $course->views + 1;
        $course->save();
        $categories = Category::all();
        return view('students.course-detail', compact('course', 'categories'));
    }

    public function courseLessons($id)
    {
        $booking = Booking::find($id);
        $student_id = auth()->user()->id;
        $course_id=$booking->course_id;
        $status = $booking->status;
        $lessons = Lesson::where('course_id', $booking->course_id)->get();
        return view('students.course-lessons', compact('lessons', 'status','student_id','course_id'));
    }

    public function courseStart($id, $teacher)
    {
        $student = auth()->user()->id;
        $bookingCheck = Booking::where('teacher_id', $teacher)->where('student_id', $student)->where('course_id', $id)->count();
        if ($bookingCheck > 0) {
            Alert::error('Error', __("messages.cource_registered_error"));
            return redirect()->route('student.course');
        }
        $booking = new Booking();
        $booking->student_id = $student;
        $booking->course_id = $id;
        $booking->teacher_id = $teacher;
        $booking->save();
        Alert::success('Success', __("messages.cource_registered"));
        return redirect()->route('student.course');
    }

    public function students(Request $request)
    {
        $course_id = $request->get('id');
        $students = Booking::with('course', 'teacher', 'student')->where('course_id', $course_id)->get();
        return view('teachers.students', compact('students'));
    }

    public function studentStatus($id)
    {
        $booking = Booking::find($id);
        if ($booking->status == 1) {
            Alert::error('Error', __("messages.student_status_error"));
        }
        $booking->status = 1;
        $booking->save();
        Alert::success('Success', __("messages.student_status"));
        return redirect()->back();
    }

    public function studentDelete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        Alert::success('Success', __("messages.student_delete"));
        return redirect()->back();
    }

    public function checkTask(Request $request, $course_id)
    {
        $student = User::where('id', $request->student_id)->first();

        $student = $student->surname." ".$student->name;

        $tasks = Task::whereHas('lesson', function ($query) use ($course_id) {
            $query->where('course_id', $course_id);
        })->where('student_id', $request->student_id)->get();

        return view('students.check-task', [
            'tasks'=>$tasks,
            'course_id'=>$course_id,
            'student'=>$student,
        ]);
    }

}
