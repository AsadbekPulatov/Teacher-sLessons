<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">{{ __("messages.categories") }}</h1>
                    <div class="d-flex justify-content-end align-items-center m-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-success">{{ __("messages.add_category") }}</a>
                    </div>
                    <table class="table table-bordered table-hover text-center">
                        <tr>
                            <th class="col-2">#</th>
                            <th class="col-8">{{ __("messages.category") }}</th>
                            <th>{{ __("messages.action") }}</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('categories.show', ['category' => $category->id]) }}"
                                       class="btn btn-info">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                       class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                          method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

