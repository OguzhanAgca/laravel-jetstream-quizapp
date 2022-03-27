<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex md:flex-row flex-col gap-4 w-full my-1">
            <div class="md:w-3/5 w-full flex flex-col">
                @if(count($quizzes) > 0)
                    <div class="flex flex-col">
                        <div class="text-sm p-2 flex gap-2 items-center rounded-md bg-slate-300 mb-2">
                            <i class="fa-solid fa-circle-exclamation fa-lg text-red-700"></i>
                            <i class="fas fa-arrow-right"></i>
                            <span class="text-slate-600">Quiz end time</span>
                        </div>
                        @foreach ($quizzes as $quiz)
                            <div class="">
                                <div class="flex flex-row justify-between items-center">
                                    <a href="{{route('quiz.detail', $quiz->quiz_slug)}}" class="text-xl font-bold">{{$quiz->quiz_title}}</a>
                                    <div class="text-sm text-red-700 relative flex flex-col items-center group">
                                        <i class="fa-solid fa-circle-exclamation fa-lg"></i>
                                        <div class="absolute bottom-0 flex flex-col items-center hidden mb-3 group-hover:flex">
                                            <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md text-center">
                                                {{$quiz->finished_at ? $quiz->finished_at : 'Indefinite'}}
                                            </span>
                                            <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('quiz.detail', $quiz->quiz_slug)}}" class="text-justify text-slate-700">
                                    {{$quiz->quiz_description ? Str::limit($quiz->quiz_description,80) : 'No description'}}
                                </a>
                                <div class="text-sm text-slate-500">
                                    Question Count: {{$quiz->get_questions_count}}
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-2">
                            @endif
                        @endforeach
                        <div class="mt-2">
                            {{$quizzes->links()}}
                        </div>
                    </div>
                @else
                    <h4 class="text-2xl font-bold text-red-600 text-center">There Is No Quiz</h4>
                @endif
            </div>

            <div class="md:w-2/5 w-full flex flex-col">
                <div class="text-center text-xl font-bold mb-2">Your Quiz Results</div>
                <div class="flex flex-col">
                    @if(count($results) > 0)
                        @foreach ($results as $result)
                            <div class="flex items-center justify-between">
                                <a href="#" class="font-semibold">{{$result->getQuiz->quiz_title}}</a>
                                <div class="text-sm p-1 rounded-md bg-green-600 text-white">{{$result->score}}</div>
                            </div>
                            @if(!$loop->last)
                                <hr class="my-2">
                            @endif
                        @endforeach
                    @else
                        <div class="text-2xl font-bold text-red-600 text-center">You Have No Results</div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
