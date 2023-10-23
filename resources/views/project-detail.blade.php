@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            <span class="mt-2 block text-xs font-normal text-gray-300">
                <a href="/projects">Projects</a> &raquo;
                <a href="#">{{ $project->projectID }}</a>
            </span>
        </div>

        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            {{ $project->projectName }}
        </div>

        <div class="flex w-full border border-red-200 p-2">
            <!-- The button to open modal -->
            <button class="btn btn-neutral btn-sm ml-4" onclick="my_modal_1.showModal()">Thêm thành viên</button>

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
                                <option selected>Viewer</option>
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
            <div class="avatar-group ml-3 h-10 -space-x-6 hidden">
                <div class="avatar">
                    <div class="w-10">
                        <img
                            src="https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-1/355911512_1499391710869593_8577894831743026955_n.jpg?stp=c62.0.240.240a_dst-jpg_p240x240&_nc_cat=105&ccb=1-7&_nc_sid=5f2048&_nc_ohc=6oh5vk9CFXEAX92M9ew&_nc_ht=scontent.fhan2-4.fna&oh=00_AfAdejbqLZ4NB-pbxBKDON4oczCWe7E09_0h0kf9dmx5Ww&oe=65382364" />
                    </div>
                </div>
                <div class="avatar">
                    <div class="w-10">
                        <img
                            src="https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-1/355911512_1499391710869593_8577894831743026955_n.jpg?stp=c62.0.240.240a_dst-jpg_p240x240&_nc_cat=105&ccb=1-7&_nc_sid=5f2048&_nc_ohc=6oh5vk9CFXEAX92M9ew&_nc_ht=scontent.fhan2-4.fna&oh=00_AfAdejbqLZ4NB-pbxBKDON4oczCWe7E09_0h0kf9dmx5Ww&oe=65382364" />
                    </div>
                </div>
                <div class="avatar">
                    <div class="w-10">
                        <img
                            src="https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-1/355911512_1499391710869593_8577894831743026955_n.jpg?stp=c62.0.240.240a_dst-jpg_p240x240&_nc_cat=105&ccb=1-7&_nc_sid=5f2048&_nc_ohc=6oh5vk9CFXEAX92M9ew&_nc_ht=scontent.fhan2-4.fna&oh=00_AfAdejbqLZ4NB-pbxBKDON4oczCWe7E09_0h0kf9dmx5Ww&oe=65382364" />
                    </div>
                </div>
                <div class="avatar placeholder relative hover:cursor-pointer">
                    <div class="w-10 bg-neutral-focus text-neutral-content">
                        <span><i class="fa-solid fa-ellipsis"></i></span>
                    </div>
                </div>
                <div class="absolute top-0 h-[400px] max-w-md rounded-lg border border-red-600 bg-white p-4 shadow-md dark:border-gray-700 dark:bg-gray-800 sm:p-8"
                    style=" max-height: 400px; overflow-y: auto;">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            View all
                        </a>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                                            alt="Neil image">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            Neil Sims
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $320
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                                            alt="Bonnie image">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            Bonnie Green
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $3467
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Michael image">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            Michael Gough
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $67
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                            alt="Lana image">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            Lana Byrd
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $367
                                    </div>
                                </div>
                            </li>
                            <li class="pb-0 pt-3 sm:pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                            alt="Thomas image">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                            Thomes Lean
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                            email@windster.com
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        $2367
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- component -->
            <!-- This is an example component -->


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
