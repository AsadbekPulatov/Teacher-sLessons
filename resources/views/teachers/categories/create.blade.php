<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center">{{ __("messages.add_category") }}</h1>
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf
                        <label for="name" class="form-label">{{ __("messages.category") }}</label>
                        <input type="text" id="name" name="name" class="form-control mb-3">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-info" style="width: 15%">{{ __("messages.save") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

