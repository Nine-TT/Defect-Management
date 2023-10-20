@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            {{ $project->projectName }}
        </div>

        <div class="flex w-full border border-red-200">
            <!-- The button to open modal -->
            <button class="btn btn-neutral btn-sm m-4" onclick="my_modal_1.showModal()">Thêm thành viên</button>

            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <h3 class="mb-4 text-lg font-bold">Thêm thành viên</h3>
                    <form method="dialog">
                        <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                    </form>

                    <form action="{{ route('handle-add-user.handleAddMemberToProject') }}" method="POST">
                        @csrf
                        <div class="group relative z-0 mb-6 w-full">
                            <input type="text" name="user_email" id="user_email"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required />
                            <label for="user_email"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Email</label>
                        </div>

                        <input class="hidden" name="projectID" type="text" value="{{ $project->projectID }}">

                        <div class="group form-control relative z-0 mb-6 w-full max-w-xs">
                            <label class="label">
                                <span class="label-text">Vai trò</span>
                            </label>
                            <select name="role" class="select select-bordered">
                                <option disabled selected>Viewer</option>
                                <option>Admin</option>
                                <option>Developer</option>
                                <option>Tester</option>
                                <option>BA</option>
                            </select>
                        </div>

                        <div class="modal-action">
                            <button class="btn" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </dialog>

            <!-- lsit user -->


        </div>

        <div>
            <h2 class="">Tên dự án: {{ $project->projectName }}</h2>
            <p>Mô tả: {{ $project->description }}</p>
        </div>
    </main>

    <script src="{{ Vite::asset('resources/js/toastify.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                showToastify('{{ session('error') }}', "red");
            @elseif (session('success'))
                showToastify('{{ session('success') }}', "green");
            @endif
        });
    </script>
@endsection
