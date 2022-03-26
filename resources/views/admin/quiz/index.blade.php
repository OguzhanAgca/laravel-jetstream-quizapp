<x-app-layout>
    <x-slot name="header">
        Quizzes / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div>
                <a href="{{route('quizzes.create')}}" class="btn btn-primary">Create Quiz</a>
            </div>

            <div>
                <table class="border-collapse w-full border border-slate-800">
                    <thead>
                        <tr>
                            <th class="table-cell">#</th>
                            <th class="table-cell text-left">Quiz</th>
                            <th class="table-cell">Status</th>
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
                                <td class="table-cell text-center">{{$quiz->finished_at}}</td>
                                <td class="table-cell text-center">
                                    <div class="flex flex-row justify-center items-center gap-2">
                                        <a href="#" class="btn btn-purple"><i class="fas fa-question py-2 fa-xl"></i></a>
                                        <a href="{{route('quizzes.edit', $quiz->quiz_id)}}" class="btn btn-primary"><i class="fas fa-pen fa-lg py-2"></i></a>
                                        <button type="button" quiz-id="{{$quiz->quiz_id}}" class="btn btn-danger remove-btn"><i class="fas fa-times fa-xl py-2"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{$quizzes->links()}}
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
