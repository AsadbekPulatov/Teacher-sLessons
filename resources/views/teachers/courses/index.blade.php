<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('courses.create') }}"
                           class="btn btn-success float-end">{{ __("messages.add_course") }}</a>
                        <h3 class="font-bold mb-3 mt-3">{{ __("messages.courses") }}</h3>
                    </div>

                    <div class="row row-cols-3">
                        @foreach($courses as $item)
                            <div class="col mb-3" style="height: 170px;">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <hr>
                                        <p class="card-text">
                                            {{ \Illuminate\Support\Str::limit($item->description, 30, '...') }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <a href="{{ route('lessons.index', ['id' => $item->id]) }}" class="card-link text-uppercase">
                                                    {{ __("messages.lessons") }}
                                                </a>
                                                <a href="{{ route('tests.index', ['id' => $item->id]) }}" class="card-link text-uppercase">
                                                    {{ __("messages.tests") }}
                                                </a>
                                                <div class="float-end">
                                                    <i class="bi bi-eye"></i> {{ $item->views }}
                                                    <i class="bi bi-heart ml-2"></i> 5
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
