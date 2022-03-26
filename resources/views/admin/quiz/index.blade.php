<x-app-layout>
    <x-slot name="header">
        Quizzes / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div>
                <a href="#" class="btn btn-primary">Create Quiz</a>
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
                                        <a href="#" class="btn btn-primary"><i class="fas fa-pen fa-lg py-2"></i></a>
                                        <button type="button" class="btn btn-danger"><i class="fas fa-times fa-xl py-2"></i></button>
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
    </x-slot>
</x-app-layout>
