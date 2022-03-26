<x-app-layout>
    <x-slot name="header">
        Questions - Create / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div class="flex flex-row justify-between items-center">
                <a href="{{route('questions.index', $quiz->quiz_id)}}" class="btn btn-purple gap-x-2"><i class="fas fa-arrow-left fa-lg"></i> Questions</a>
                <div class="text-red-700">* Required Fields</div>
            </div>

            <div>
                <form action="{{route('questions.store', $quiz->quiz_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="quiz_title" class="form-label">Quiz Title <span class="text-red-700">*</span></label>
                        <input type="text" name="quiz_title" id="quiz_title" value="{{$quiz->quiz_title}}" class="form-control bg-slate-400" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Question <span class="text-red-700">*</span></label>
                        <textarea name="question" id="question" cols="50" rows="5" class="form-control">{{old('question')}}</textarea>
                        @error('question')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="question_image" class="form-label">Image</label>
                        <input type="file" name="question_image" id="question_image" class="form-control p-2 border">
                        @error('question_image')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="flex md:flex-row flex-col md:gap-5 gap-0">
                        <div class="flex-1">
                            <div class="mb-3">
                                <label for="answer_a" class="form-label">Option A <span class="text-red-700">*</span></label>
                                <input type="text" name="answer_a" id="answer_a" class="form-control" value="{{old('answer_a')}}">
                                @error('answer_a')
                                    <div class="text-red-700 mt-1">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="answer_b" class="form-label">Option B <span class="text-red-700">*</span></label>
                                <input type="text" name="answer_b" id="answer_b" class="form-control" value="{{old('answer_b')}}">
                                @error('answer_b')
                                    <div class="text-red-700 mt-1">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-3">
                                <label for="answer_c" class="form-label">Option C <span class="text-red-700">*</span></label>
                                <input type="text" name="answer_c" id="answer_c" class="form-control" value="{{old('answer_c')}}">
                                @error('answer_c')
                                    <div class="text-red-700 mt-1">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="answer_d" class="form-label">Option D <span class="text-red-700">*</span></label>
                                <input type="text" name="answer_d" id="answer_d" class="form-control" value="{{old('answer_d')}}">
                                @error('answer_d')
                                    <div class="text-red-700 mt-1">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Correct Option <span class="text-red-700">*</span></label>
                        <select name="correct_answer" id="correct_answer" class="form-control">
                            <option @if(old('correct_answer') == 'answer_a') selected @endif value="answer_a">Option A</option>
                            <option @if(old('correct_answer') == 'answer_b') selected @endif value="answer_b">Option B</option>
                            <option @if(old('correct_answer') == 'answer_c') selected @endif value="answer_c">Option C</option>
                            <option @if(old('correct_answer') == 'answer_d') selected @endif value="answer_d">Option D</option>
                        </select>
                        @error('correct_answer')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="flex flex-row gap-x-4">
                        <a href="{{route('questions.index', $quiz->quiz_id)}}" class="btn btn-danger flex-1 justify-center">Cancel</a>
                        <button type="submit" class="btn btn-primary flex-1 justify-center">Create Question</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
