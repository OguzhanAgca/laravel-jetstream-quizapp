<x-app-layout>
    <x-slot name="header">
        Users / Admin
    </x-slot>

    <x-slot name="content">
        <div class="container p-4 flex flex-col gap-5">
            <div class="flex">
                <a href="{{route('quizzes.home')}}" class="btn btn-primary gap-2">Return Home</a>
            </div>

            <div>
                <div class="overflow-x-auto w-full">
                    <table class="border-collapse w-full border border-slate-800">
                        <thead>
                            <tr>
                                <th class="table-cell">#</th>
                                <th class="table-cell">Profile Photo</th>
                                <th class="table-cell">Name</th>
                                <th class="table-cell">Email</th>
                                <th class="table-cell">Role</th>
                                <th class="table-cell">Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-slate-300">
                                    <td class="table-cell text-center">{{$user->id}}</td>
                                    <td class="table-cell">
                                        <div class="flex items-center justify-center">
                                            <img src="{{$user->profile_photo_url}}" alt="Profile Pic" class="rounded-full" width="50">
                                        </div>
                                    </td>
                                    <td class="table-cell text-center">{{$user->name}}</td>
                                    <td class="table-cell text-center">{{$user->email}}</td>
                                    <td class="table-cell text-center first-letter:uppercase">{{$user->type}}</td>
                                    <td class="table-cell text-center">
                                        <div class="flex flex-row justify-center items-center gap-2">
                                            
                                            <span class="relative flex flex-col items-center group">
                                                <button user-id="{{$user->id}}" type="button" class="btn btn-primary edit-user"><i class="fas fa-pen fa-lg py-2"></i></button>
                                                <div class="absolute bottom-0 flex-col items-center hidden mb-8 group-hover:flex">
                                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg rounded-md">
                                                        Edit
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
                    {{$users->links()}}
                </div>
            </div>
        </div>

        {{-- User Edit Modal --}}
        <div class="modal" id="user_edit_modal">
            <div class="modal-content">
                <div class="flex flex-row items-center justify-between">
                    <h4 class="text-xl font-bold">User Role</h4>
                    <i class="fas fa-times fa-lg reject-btn hover:cursor-pointer"></i>
                </div>
                <hr class="my-3">
                <div>
                    <form id="user_edit_form" action="{{route('users.update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="mb-2">
                            <label for="type" class="form-label">User Role</label>
                            <select name="type" id="type" class="form-control">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </form>
                </div>
                <hr class="my-3">
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-dark reject-btn">Cancel</button>
                        <button type="submit" form="user_edit_form" class="btn btn-danger">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click', '.edit-user', function(){
                    $('#user_edit_modal').addClass('modal-active');
                    const id = $(this)[0].getAttribute('user-id');
                    $('#id').val(id);
                });

                $(document).on('click', '.reject-btn', function(){
                    $('#user_edit_modal').removeClass('modal-active');
                });
            });
        </script>
    </x-slot>
</x-app-layout>
