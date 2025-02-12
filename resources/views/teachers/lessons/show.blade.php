<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="fs-4 font-bold">{{ $lesson->theme }}</p>
                    @if($lesson->file)
                        <div class="mt-5">
                            <p>{{ __("messages.lesson_file") }}</p>
                            <a href="{{ asset('uploads/files/'.$lesson->file) }}" download>{{ $lesson->file }}</a>
                            {{--                            <iframe src="{{ asset('uploads/files/'.$lesson->file) }}" frameborder="0" width="100%" height="1000px"></iframe>--}}
                        </div>
                    @endif
                    @if($lesson->video)
                        <div class="mt-5">
                            <p>{{ __("messages.lesson_video") }}</p>
                            <iframe src="{{ $lesson->video }}" frameborder="0" width="70%" height="500px"></iframe>
                        </div>
                    @endif
                    @if($lesson->task)
                        <div class="mt-5">
                            <p>{{ __("messages.lesson_task") }}</p>
                            <a href="{{ asset('uploads/tasks/'.$lesson->task) }}" download>{{ $lesson->task }}</a>
                            {{--                            <iframe src="{{ asset('uploads/tasks/'.$lesson->task) }}" frameborder="0" width="100%" height="1000px"></iframe>--}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
        @if(isset($lesson->tasks))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="d-flex align-items-center">
                                <a href="{{ asset('uploads/tasks/' . $lesson->tasks->task) }}"
                                   target="_blank" style="margin-right: 20px;">{{ $lesson->tasks->task }}</a>
                                <button class="@if ($lesson->tasks->baho < 60)btn btn-danger @else btn btn-success @endif">
                                    Baho: {{ $lesson->tasks->baho }} %</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <form action="{{route('tasks.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                <input type="file" name="task" accept=".pdf" class="form-control" required>
                                <button class="btn btn-info mt-1 justify-content-end">Vazifa yuklash</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

</x-app-layout>
@include('sweetalert::alert')
