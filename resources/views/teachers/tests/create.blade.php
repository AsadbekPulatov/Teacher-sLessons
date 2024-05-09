<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="fs-4 font-bold">{{ __("messages.add_test") }}</p>
                    <form action="{{ route('tests.store') }}" method="post">
                        @csrf
                        <div class="mt-4">
                            <label for="question" class="block text-gray-700 text-sm font-bold mb-2">{{ __("messages.question") }}:</label>
                            <input type="text" name="question" id="question" class="form-control" required>
                            @error('question')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">{{ __("messages.answers") }}:</label>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" name="currect" value="0" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" name="currect" value="1" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" name="currect" value="2" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" name="currect" value="3" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-info font-bold py-2 px-4 rounded">{{ __("messages.save") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
