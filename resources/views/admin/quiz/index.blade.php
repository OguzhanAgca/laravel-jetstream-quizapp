<x-app-layout>
    <x-slot name="header">
        Quizzes / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div class="flex md:flex-row flex-col-reverse justify-between md:items-center items-stretch gap-3">
                <a href="{{route('quizzes.create')}}" class="btn btn-primary">Create Quiz</a>
                <form method="get">
                    <div class="flex flex-row gap-3 items-center">
                        <input type="text" name="quiz" id="quiz" class="form-control" placeholder="Search.." value="{{Request::get('quiz')}}">
                        <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                            <option selected disabled>-- Status --</option>
                            <option @if(Request::get('status') == 'publish') selected @endif value="publish">Publish</option>
                            <option @if(Request::get('status') == 'draft') selected @endif value="draft">Draft</option>
                            <option @if(Request::get('status') == 'passive') selected @endif value="passive">Passive</option>
                        </select>
                        @if(Request::get('quiz') || Request::get('status'))
                            <a href="{{route('quizzes.index')}}" class="btn btn-danger mt-1"><i class="fas fa-times fa-xl py-2.5"></i></a>
                        @endif
                    </div>
                </form>
            </div>

            <div>
                <div class="overflow-x-auto w-full">
                    <table class="border-collapse w-full border border-slate-800">
                        <thead>
                            <tr>
                                <th class="table-cell">#</th>
                                <th class="table-cell text-left">Quiz</th>
                                <th class="table-cell">Status</th>
                                <th class="table-cell">Question</th>
                                <th class="table-cell">Finished At</th>
                                <th class="table-cell">Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $quiz)
                                <tr class="hover:bg-slate-300">
                                    <td class="table-cell text-center">{{$quiz->quiz_id}}</td>
                                    <td class="table-cell">{{$quiz->quiz_title}}</td>
                                    <td class="table-cell text-center">
                                        @switch($quiz->quiz_status)
                                            @case('publish')
                                                <span class="p-1 rounded-md bg-green-600 text-white text-sm">Publish</span>
                                                @break
                                            @case('draft')
                                                <span class="p-1 rounded-md bg-yellow-600 text-white text-sm">Draft</span>
                                                @break
                                            @default
                                                <span class="p-1 rounded-md bg-red-600 text-white text-sm">Passive</span>
                                        @endswitch
                                    </td>
                                    <td class="table-cell text-center">{{$quiz->get_questions_count}}</td>
                                    <td class="table-cell text-center cursor-default">
                                        <div class="relative flex flex-col items-center group">
                                            {{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-'}}
                                            <div class="absolute bottom-0 flex-col items-center hidden mb-6 group-hover:flex">
                                                <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md">
                                                    {{$quiz->finished_at}}
                                                </span>
                                                <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-cell text-center">
                                        <div class="flex flex-row justify-center items-center gap-2">
                                            <span class="relative flex flex-col items-center group">
                                                <a href="{{route('questions.index', $quiz->quiz_id)}}" class="btn btn-purple"><i class="fas fa-question py-2 fa-xl"></i></a>
                                                <div class="absolute bottom-0 flex-col items-center hidden mb-8 group-hover:flex">
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md">
                                                        Questions
                                                    </span>
                                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                                </div>
                                            </span>
                                            <span class="relative flex flex-col items-center group">
                                                <a href="{{route('quizzes.edit', $quiz->quiz_id)}}" class="btn btn-primary"><i class="fas fa-pen fa-lg py-2"></i></a>
                                                <div class="absolute bottom-0 flex-col items-center hidden mb-8 group-hover:flex">
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md">
                                                        Edit
                                                    </span>
                                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                                </div>
                                            </span>
                                            <span class="relative flex flex-col items-center group">
                                                <button type="button" quiz-id="{{$quiz->quiz_id}}" class="btn-danger btn remove-btn"><i class="fas fa-times fa-xl py-2"></i></button>
                                                <div class="absolute bottom-0 flex-col items-center hidden mb-8 group-hover:flex">
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md">
                                                        Delete
                                                    </span>
                                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                                </div>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{$quizzes->withQueryString()->links()}}
                </div>
            </div>
        </div>

        {{-- Quiz Remove Modal --}}
        <div class="modal" id="quiz_delete_modal">
            <div class="modal-content">
                <div class="flex flex-row items-center justify-between">
                    <h4 class="text-xl font-bold">Are you sure?</h4>
                    <i class="fas fa-times fa-lg reject-btn hover:cursor-pointer"></i>
                </div>
                <hr class="my-3">
                <div>
                    <p>This quiz and all the questions in it will be deleted.</p>
                    <form id="quiz_delete_form" action="{{route('quizzes.delete')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="quiz_id" id="quiz_id">
                    </form>
                </div>
                <hr class="my-3">
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-dark reject-btn">Cancel</button>
                        <button type="submit" form="quiz_delete_form" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click', '.remove-btn', function(){
                    $('#quiz_delete_modal').addClass('modal-active');
                    const id = $(this)[0].getAttribute('quiz-id');
                    $('#quiz_id').val(id);
                });

                $(document).on('click', '.reject-btn', function(){
                    $('#quiz_delete_modal').removeClass('modal-active');
                });
            });
        </script>
    </x-slot>
</x-app-layout>
