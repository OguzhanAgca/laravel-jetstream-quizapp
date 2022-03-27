<x-app-layout>
    <x-slot name="header">
        {{$quiz->quiz_title}}
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex md:flex-row flex-col gap-5">
            <div class="flex flex-col md:w-2/5 w-full">
                <div class="text-xl font-bold text-center mb-2">Quiz Details</div>
                <div class="flex items-center justify-between px-2">
                    <h4 class="text-lg font-semibold">Quiz End Time</h4>
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
                <hr class="my-2">
                <div class="flex items-center justify-between px-2">
                    <h4 class="text-lg font-semibold">Question Count</h4>
                    <div class="p-1 rounded-md bg-slate-600 text-white text-sm">{{$quiz->get_questions_count}}</div>
                </div>
                <hr class="my-2">
                <div class="flex items-center justify-between px-2">
                    <h4 class="text-lg font-semibold">Total Participants</h4>
                    <div class="p-1 rounded-md bg-slate-600 text-white text-sm">{{$quiz->total_participants}}</div>
                </div>
                <hr class="my-2">
                <div class="flex items-center justify-between px-2">
                    <h4 class="text-lg font-semibold">Average Score</h4>
                    <div class="p-1 rounded-md bg-slate-600 text-white text-sm">{{$quiz->quiz_score_average}}</div>
                </div>

                <div class="text-xl font-bold text-center my-2">Top Ten User</div>
                @if(count($quiz->getTopTenUser) > 0)
                @foreach ($quiz->getTopTenUser as $result)
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row gap-3 items-center">
                            <img src="{{$result->getUser->profile_photo_url}}" alt="UI" width="30" class="rounded-full">
                            <div>{{$result->getUser->name}}</div>
                        </div>
                        <div class="p-1 rounded-md bg-green-700 text-white text-sm">
                            {{$result->score}}
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr class="my-2">
                    @endif
                @endforeach
                @else
                    <div class="text-lg text-red-700 font-bold text-center">No participants yet</div>
                @endif
            </div>
            <div class="flex flex-col md:w-3/5 w-full gap-2">
                <div class="text-slate-700">{{$quiz->quiz_description}}</div>
                <div>
                    <a href="{{route('quiz.join', $quiz->quiz_slug)}}" class="btn btn-primary block w-full justify-center">Join Quiz</a>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
