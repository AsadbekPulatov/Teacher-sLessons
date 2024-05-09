<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="fs-4 font-bold">{{ __("messages.edit_lesson") }}</p>
                    <form action="{{ route('tests.update', $test->id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <label for="question" class="block text-gray-700 text-sm font-bold mb-2">{{ __("messages.question") }}:</label>
                            <input type="text" name="question" id="question" class="form-control" required value="{{ $test->question }}">
                            @error('question')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <?php
                            $answers = $test->answers;
                        ?>
                        <div class="mt-4">
                            <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">{{ __("messages.answers") }}:</label>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" @if($answers[0]->is_correct) checked @endif name="currect" value="0" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required value="{{ $answers[0]->answer }}">
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" @if($answers[1]->is_correct) checked @endif name="currect" value="1" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required value="{{ $answers[1]->answer }}">
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" @if($answers[2]->is_correct) checked @endif name="currect" value="2" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required value="{{ $answers[2]->answer }}">
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <input type="radio" @if($answers[3]->is_correct) checked @endif name="currect" value="3" class="form-radio" style="margin-right: 10px;">
                                <input type="text" name="answer[]" id="answer1" class="form-control" required value="{{ $answers[3]->answer }}">
                            </div>
                        </div>
                        <input type="hidden" name="course_id" value="{{ $test->course_id }}">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-info font-bold py-2 px-4 rounded">{{ __("messages.save") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
