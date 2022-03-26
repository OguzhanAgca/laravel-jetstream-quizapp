<x-app-layout>
    <x-slot name="header">
        Questions / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col">
            <div class="flex flex-row items-center justify-between">
                <a href="{{route('quizzes.index')}}" class="btn btn-dark"><i class="fas fa-arrow-left fa-lg"></i> Admin / Quizzes</a>
                <a href="{{route('questions.create', $quiz->quiz_id)}}" class="btn btn-primary">Create Question</a>
            </div>

            <div>
                <div class="overflow-x-auto w-full">
                    <table class="border-collapse w-full border border-slate-800">
                        <caption class="mb-1">{{$quiz->quiz_title}}</caption>
                        <thead>
                            <tr>
                                <th class="table-cell">Image</th>
                                <th class="table-cell text-left">Question</th>
                                <th class="table-cell">Option A</th>
                                <th class="table-cell">Option B</th>
                                <th class="table-cell">Option C</th>
                                <th class="table-cell">Option D</th>
                                <th class="table-cell">Answer</th>
                                <th class="table-cell">Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr class="hover:bg-slate-300">
                                    <td class="table-cell text-center">
                                        @if($question->question_image)
                                            <img src="{{asset('uploads').'/'.$question->question_image}}" alt="Q.Image" width="350">
                                        @else
                                            <div class="p-1 bg-slate-600 text-white rounded-md">No Image</div>
                                        @endif
                                    </td>
                                    <td class="table-cell">{{$question->question}}</td>
                                    <td class="table-cell text-center">{{$question->answer_a}}</td>
                                    <td class="table-cell text-center">{{$question->answer_b}}</td>
                                    <td class="table-cell text-center">{{$question->answer_c}}</td>
                                    <td class="table-cell text-center">{{$question->answer_d}}</td>
                                    <td class="table-cell text-center w-28">
                                        <div class="p-1 rounded-full bg-green-700 text-white font-bold">
                                            Option 
                                            <span class="uppercase">{{substr($question->correct_answer, -1)}}</span>
                                        </div>
                                    </td>
                                    <td class="table-cell text-center">
                                        <div class="flex flex-row justify-center items-center gap-2">
                                            <a href="#" class="btn btn-purple"><i class="fas fa-question py-2 fa-xl"></i></a>
                                            <a href="#" class="btn btn-primary"><i class="fas fa-pen fa-lg py-2"></i></a>
                                            <button type="button" class="btn btn-danger"><i class="fas fa-times fa-xl py-2"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{$questions->links()}}
                </div>
            </div>
        </div>

        {{-- Question Remove Modal --}}
        <div class="modal" id="question_delete_modal">
            <div class="modal-content">
                <div class="flex flex-row items-center justify-between">
                    <h4 class="text-xl font-bold">Are you sure?</h4>
                    <i class="fas fa-times fa-lg reject-btn hover:cursor-pointer"></i>
                </div>
                <hr class="my-3">
                <div>
                    <p>This quiz and all the questions in it will be deleted.</p>
                    <form id="question_delete_form" action="{{route('quizzes.delete')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="question_id" id="question_id">
                    </form>
                </div>
                <hr class="my-3">
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-dark reject-btn">Cancel</button>
                        <button type="submit" form="question_delete_form" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click', '.remove-btn', function(){
                    $('#question_delete_modal').addClass('modal-active');
                    const id = $(this)[0].getAttribute();
                    $('#question_id').val(id);
                });

                $(document).on('click', '.reject-btn', function(){
                    $('#question_delete_modal').removeClass('modal-active');
                });
            });
        </script>
    </x-slot>
</x-app-layout>
