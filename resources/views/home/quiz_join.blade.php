<x-app-layout>
    <x-slot name="header">
        {{$quiz->quiz_title}}
    </x-slot>

    <x-slot name="content">
        @php
            $options = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
        @endphp
        <div class="flex flex-col w-full p-4">
            <form action="{{route('quiz.store', $quiz->quiz_slug)}}" method="post">
                @csrf
                @foreach ($quiz->getQuestions as $question)
                    <div class="flex flex-col gap-2">
                        @if($question->question_image)
                            <div>
                                <img src="{{asset('uploads').'/'.$question->question_image}}" alt="QuestionImage" class="rounded-md" width="350">
                            </div>
                        @endif
    
                        <div class="flex flex-row gap-3 items-center">
                            <div class="text-slate-700 font-bold text-lg ">{{$loop->iteration.'- '.$question->question}}</div>
                            <button type="button" class="px-2 py-1 rounded-md bg-red-700 hover:bg-red-800 text-white uppercase text-sm border border-transparent tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition font-semibold hidden clear-btn" question-id="{{$question->question_id}}">Clear</button>
                        </div>
    
                        @foreach ($options as $option)
                            <div class="flex flex-row gap-2 items-center">
                                <input type="radio" name="{{$question->question_id}}" id="{{$option.'_'.$question->question_id}}" class="form-check">
                                <label for="{{$option.'_'.$question->question_id}}" class="mt-1">{{$question->$option}}</label>
                            </div>
                        @endforeach
                    </div>
                    @if(!$loop->last)
                        <hr class="my-2">
                    @endif
                @endforeach
                <div class="my-2">
                    <button type="submit" class="btn btn-success block w-full justify-center">Finish Quiz</button>
                </div>
            </form>
        </div>
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change', '[type=radio]', function(){
                    const questionId = $(this)[0].getAttribute('name');
                    $(`[question-id=${questionId}]`).removeClass('hidden');
                });

                $(document).on('click', '.clear-btn', function(){
                    const questionId = $(this)[0].getAttribute('question-id');
                    $(`[name=${questionId}]`).prop('checked',false);
                    $(this).addClass('hidden');
                });
            });
        </script>
    </x-slot>
</x-app-layout>
