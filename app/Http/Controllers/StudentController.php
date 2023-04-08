<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student')->only('course', 'courseDetail', 'courseStart', 'studentStatus');
        $this->middleware('role:teacher')->only('studentStatus', 'students');
    }

    public function course(Request $request)
    {
        $category = $request->get('category');
        if ($category) {
            $courses = Course::where('category_id', $category)->get();
        } else {
            $courses = Course::all();
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

    public function students()
    {
        $teacher = auth()->user()->id;
        $courses = Course::where('user_id', $teacher)->get();
        $students = [];
        foreach ($courses as $course) {
            $bookings = Booking::where('course_id', $course->id)->get();
            foreach ($bookings as $booking) {
                $student = User::where('id', $booking->student_id)->first();
                array_push($students, ['student'=>$student, 'course' => $course]);
            }
        }
        return view('teachers.students', compact('students'));
    }

    public function studentStatus()
    {
        $student = auth()->user()->id;
        $bookings = Booking::where('student_id', $student)->get();
        $categories = Category::all();
        return view('students.status', compact('bookings', 'categories'));
    }
}
