<x-app-layout>
    <x-slot name="header">
        {{$quiz->quiz_title}}
    </x-slot>

    <x-slot name="content">
        @php
            $options = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
        @endphp
        <div class="flex flex-col w-full p-4">
            <div class="p-2 bg-green-600 text-white rounded-md">Your score: {{$quiz->getAuthUserResult()->score}}</div>
            @foreach ($quiz->getQuestions as $question)
                <div class="flex flex-col gap-2">
                    @if($question->question_image)
                        <div>
                            <img src="{{asset('uploads').'/'.$question->question_image}}" alt="QuestionImage" class="rounded-md" width="350">
                        </div>
                    @endif

                    <div class="flex flex-row gap-3 items-center">
                        <div class="text-slate-700 font-bold text-lg ">
                            @if($question->correct_answer === $question->getUserAnswers->answer)
                                <span class="text-green-700 font-bold"><i class="fas fa-check"></i></span>
                            @else
                                <span class="text-red-700 font-bold"><i class="fas fa-times"></i></span>
                            @endif
                            {{$loop->iteration.'- '.$question->question}}
                        </div>
                    </div>

                    

                    @foreach ($options as $option)
                        <div class="flex flex-row gap-2 items-center">
                            <input type="radio" class="form-check" disabled @if($question->getUserAnswers->answer === $option) checked @endif>
                            <label class="mt-1">{{$question->$option}}</label>
                            @if($question->correct_answer === $option)
                                <div class="text-green-700 font-bold mt-1"><i class="fas fa-arrow-right"></i> Correct Answer</div>
                            @elseif($question->getUserAnswers->answer === $option)
                                <div class="text-blue-700 font-bold mt-1"><i class="fas fa-arrow-right"></i> Your Answer</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if(!$loop->last)
                    <hr class="my-2">
                @endif
            @endforeach
        </div>

        <div class="w-full p-4">
            <a href="{{url()->previous()}}" class="btn btn-purple">Go Back</a>
        </div>
    </x-slot>
</x-app-layout>
