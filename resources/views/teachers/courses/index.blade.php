<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
    {{--            {{ __('Dashboard') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('courses.create') }}"
                       class="btn btn-success font-bold py-2 px-4 rounded">{{ __("messages.add_course") }}</a>
                    <h3 class="font-bold mb-3 mt-3">{{ __("messages.courses") }}</h3>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="col-2">#</th>
                            <th class="col-6">{{ __("messages.title") }}</th>
                            <th class="col-4">{{ __("messages.action") }}</th>
                        </tr>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('lessons.index', ['id' => $course->id]) }}" class="btn btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('courses.destroy', $course) }}"
                                              method="post" id="course-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
