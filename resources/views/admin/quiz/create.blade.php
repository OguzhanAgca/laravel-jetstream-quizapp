<x-app-layout>
    <x-slot name="header">
        Quizzes - Create / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div class="flex flex-row justify-between items-center">
                <a href="{{route('quizzes.index')}}" class="btn btn-purple gap-x-2"><i class="fas fa-arrow-left fa-lg"></i> Quizzes</a>
                <div class="text-red-700">* Required Fields</div>
            </div>

            <div>
                <form action="{{route('quizzes.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="quiz_title" class="form-label">Quiz Title <span class="text-red-700">*</span></label>
                        <input type="text" name="quiz_title" id="quiz_title" value="{{old('quiz_title')}}" class="form-control">
                        @error('quiz_title')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quiz_description" class="form-label">Quiz Description</label>
                        <textarea name="quiz_description" id="quiz_description" cols="50" rows="5" class="form-control">{{old('quiz_description')}}</textarea>
                        @error('quiz_description')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 flex flex-row items-center gap-x-2">
                        <input type="checkbox" name="is_finished_at" id="is_finished_at" class="form-check" @if(old('finished_at')) checked @endif>
                        <label for="is_finished_at" class="form-label mt-1">Finished At</label>
                    </div>
                    <div class="mb-3">
                        <input type="datetime-local" name="finished_at" id="finished_at" class="form-control" @if(!old('finished_at')) style="display: none" @endif value="{{old('finished_at')}}">
                        @error('finished_at')
                            <div class="text-red-700 mt-1">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="flex flex-row gap-x-4">
                        <a href="{{route('quizzes.index')}}" class="btn btn-danger flex-1 justify-center">Cancel</a>
                        <button type="submit" class="btn btn-primary flex-1 justify-center">Create Quiz</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change', '#is_finished_at', function(){
                    const isChecked = $(this).prop('checked');

                    if(isChecked){
                        $('#finished_at').show('fast');
                    } else {
                        $('#finished_at').hide('fast').val(null);
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
