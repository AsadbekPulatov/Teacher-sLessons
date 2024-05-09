<x-app-layout>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="d-flex justify-content-around float-end" style="width: 50%;">
                            <form action="{{ route('test.import') }}" method="post" enctype="multipart/form-data"
                                  class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $id }}">
                                <input type="file" name="file" accept=".txt" class="form-control" required>
                                <button type="submit" class="btn btn-info">Import</button>
                            </form>
                            <a href="{{ route('tests.create', ['id' => $id]) }}"
                               class="btn btn-success">{{ __("messages.add_test") }}</a>
                        </div>
                        <h3 class="font-bold mb-3 mt-3">{{ __("messages.tests") }}</h3>
                    </div>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-9">{{ __("messages.question") }}</th>
                            <th class="col-2">{{ __("messages.action") }}</th>
                        </tr>
                        @foreach($lessons as $lesson)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $lesson->question }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-around">
                                        <a href="{{ route('tests.edit', $lesson->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('tests.destroy', $lesson) }}"
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
