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
                                    <div class="d-flex flex-column">
                                        @if($item->status == 1)
                                            <a class="btn btn-success mb-1">
                                                <i class="bi bi-check-circle"></i>
                                                {{ __("messages.check") }}
                                            </a>
                                        @else
                                            <a href="{{ route('student-status', $item->id) }}"
                                               class="btn btn-warning mb-1">
                                                <i class="bi bi-plus"></i>
                                                {{ __("messages.add_student") }}
                                            </a>
                                        @endif
                                        <button onclick="show({{ $item }})" type="button" class="btn btn-primary mb-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                            <i class="bi bi-eye"></i>
                                            {{ __("messages.show") }}
                                        </button>
                                        <a href="{{ route('student-delete', $item->id) }}" class="btn btn-danger mb-1">
                                            <i class="bi bi-trash"></i>
                                            {{ __("messages.delete") }}
                                        </a>


                                        <form action="{{ route('check-task', $item['course']->id)}}" method="get">
                                            <input class="bi bi-trash" type="hidden" name="student_id"
                                                   value="{{$item['student']->id}}">
                                            <button type="submit" class="btn btn-info w-100 mb-1">
                                                <i class="bi bi-book"></i>
                                                {{ __("messages.task") }}
                                            </button>
                                        </form>

                                        <form action="{{ route('test.show_result', $item['course']->id)}}" method="get">
                                            <input class="bi bi-trash" type="hidden" name="student_id"
                                                   value="{{$item['student']->id}}">
                                            <button type="submit" class="btn btn-secondary w-100 mb-1">
                                                <i class="bi bi-bar-chart"></i>
                                                {{ __("messages.tests") }}
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

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <script>
        function show(item) {
            console.log(item);
            document.querySelector('.modal-title').innerHTML = item.student.name + ' ' + item.student.surname;
            document.querySelector('.modal-body').innerHTML = `
                <div class="p-3">
                <p>{{ __("messages.name") }}: ${item.student.name}</p>
                <p>{{ __("messages.surname") }}: ${item.student.surname}</p>
                <p>{{ __("messages.phone") }}: ${item.student.phone}</p>
                <p>{{ __("messages.country") }}: ${item.student.country}</p>
                <p>{{ __("messages.city") }}: ${item.student.city}</p>
                <p>{{ __("messages.courses") }}: ${item.course.title}</p>
                <p>{{ __("messages.price") }}: ${item.course.price}</p>
                </div>
            `;
        }
    </script>
</x-app-layout>
