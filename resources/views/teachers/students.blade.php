<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h3 class="font-bold mb-3 mt-3">{{ __("messages.students") }}</h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-3">{{ __("messages.name") }} {{ __("messages.surname") }}</th>
                            <th class="col-2">{{ __("messages.phone") }}</th>
{{--                            <th class="col-2">{{ __("messages.country") }} {{ __("messages.city") }}</th>--}}
                            <th class="col-2">{{ __("messages.courses") }}</th>
                            <th class="col-2">{{ __("messages.price") }}</th>
                            <th class="col-2">{{ __("messages.action") }}</th>
                        </tr>
                        @foreach($students as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item['student']->name }} {{ $item['student']->surname }}</td>
                                <td>{{ $item['student']->phone }}</td>
{{--                                <td>{{ $item['student']->country }} {{ $item['student']->city }}</td>--}}
                                <td>{{ $item['course']->title }}</td>
                                <td>{{ $item['course']->price }}</td>
                                <td>
{{--                                    <div class="d-flex align-items-center justify-content-around">--}}
{{--                                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-info">--}}
{{--                                            <i class="bi bi-eye"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-warning">--}}
{{--                                            <i class="bi bi-pencil"></i>--}}
{{--                                        </a>--}}
{{--                                        <form action="{{ route('lessons.destroy', $lesson) }}"--}}
{{--                                              method="post" id="course-form">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <button type="submit" class="btn btn-danger">--}}
{{--                                                <i class="bi bi-trash"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
