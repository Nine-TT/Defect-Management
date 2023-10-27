@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Chi tiết dự án
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/projects">Dự án</a></li>
                    <li>{{ $project->projectID }}</li>
                </ul>
            </div>
        </div>

        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            {{ $project->projectName }}
        </div>

        <div class="flex w-full items-center border border-gray-300 p-2">

            <a href="{{ route('error.index', ['projectID' => $project->projectID]) }}">
                <div class="btn btn-neutral btn-sm ml-4">
                    Quản lý task
                </div>
            </a>

            @if ($checkRoleAdmin == true)
                <!-- The button to open modal -->
                <div>
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
                                        <option>Admin</option>
                                        <option>Developer</option>
                                        <option selected>Tester</option>
                                    </select>
                                </div>

                                <div class="modal-action">
                                    <button class="btn" type="submit">Xác nhận</button>
                                </div>
                            </form>
                        </div>
                    </dialog>
                </div>

                <!-- Action tao loai kiem thu -->
                @php
                    $projectID = $project->projectID;
                @endphp

                @include('modal/create_test_type', ['projectID' => $projectID, 'stt' => '1'])

                <!-- Action tao loai loi -->
                <button class="btn btn-neutral btn-sm ml-4" onclick="my_modal_3.showModal()">Tạo loại lỗi</button>
                <dialog id="my_modal_3" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                        </form>
                        <h3 class="text-lg font-bold">Tạo loại lỗi</h3>

                        <form action="{{ route('handleCreateErrorType.projects', ['projectID' => $projectID]) }}"
                            method="post">
                            @csrf
                            <div>
                                <div class="z-0 mb-6 w-full">
                                    <input type="text" name="error_type"
                                        class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                        required />
                                </div>
                                <input type="text" name="projectID" value="{{ $projectID }}" class="hidden">

                            </div>
                            <div class="modal-action">
                                <form method="dialog">
                                    <button class="btn" type="submit">Xác nhận</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </dialog>
                <!-- ---- -->

                <!-- Sua thong tin du an -->
                <button class="btn btn-neutral btn-sm ml-4" onclick="my_modal_2.showModal()">Sửa thông tin</button>
                <dialog id="my_modal_2" class="modal">
                    <div class="modal-box">
                        <form method="dialog">
                            <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                        </form>
                        <h3 class="text-lg font-bold">Thông tin</h3>

                        <form action="{{ route('handleChangeProjectInfo.projects', ['projectID' => $projectID]) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="z-0 mb-6 w-full">
                                    <input type="text" name="projectName"
                                        class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                        value="{{ $project->projectName }}" required />
                                </div>
                                <input type="text" name="projectID" value="{{ $projectID }}" class="hidden">
                                <div class="group relative z-0 mb-6 w-full">
                                    <textarea name="description" id="description"
                                        class="peer block h-28 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                        required>{{ $project->description }}</textarea>
                                    <label for="description"
                                        class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Mô
                                        tả dự án</label>
                                </div>

                            </div>
                            <div class="modal-action">
                                <form method="dialog">
                                    <button class="btn" type="submit">Xác nhận</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </dialog>
            @endif




            <!-- lsit user -->
            <div class="ml-4 flex -space-x-4">
                @foreach ($listUser as $key => $users)
                    @if ($key < 3)
                        @if ($users->urlImage != null)
                            <img class="h-10 w-10 rounded-full border-2 border-white dark:border-gray-800"
                                src="{{ asset('storage/' . $users->urlImage) }}" alt="">
                        @else
                            <a class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-center text-xs font-medium text-white hover:bg-gray-600 dark:border-gray-800"
                                href="#">{{ substr(trim($users->firstName), 0, 1) }}</a>
                        @endif
                    @endif
                @endforeach

                <a class="hover-bg-gray-600 flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-gray-700 text-xs font-medium text-white dark:border-gray-800"
                    href="{{ route('projects.member', ['projectID' => $project->projectID]) }}"><i
                        class="fa-solid fa-ellipsis"></i></a>
            </div>
        </div>

        <!-- body content -->
        <div class="mx-[auto] my-6 flex w-[96%] flex-col lg:flex-row">
            <div class="card rounded-box grid h-96 flex-grow place-items-center border border-gray-400 bg-base-200">content
            </div>
            <div class="divider lg:divider-horizontal"></div>
            <div class="card rounded-box flex h-96 flex-row border border border-gray-400 bg-base-200">
                <div class="ml-4 flex-1">
                    <h3 class="mx-3 border-b border-gray-500 font-bold">Loại kiểm thử</h3>
                    <ul class="mt-4 max-h-80 space-y-4 overflow-y-auto text-left text-gray-500 dark:text-gray-400">
                        @foreach ($listTestType as $testType)
                            <li class="flex items-center space-x-3">
                                <div class="flex w-[300px] items-center justify-between">
                                    <svg class="h-3.5 w-3.5 flex-shrink-0 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="text-black">{{ $testType->typeName }}</span>
                                    <form
                                        action="{{ route('deleteTestType.projectMember', ['projectID' => $project->projectID]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="test_type_id" class="hidden"
                                            value="{{ $testType->testTypeID }}">
                                        <button type="submit" class="hover:cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="divider lg:divider-horizontal"></div>
                <div class="mr-4 flex-1">
                    <h3 class="mx-3 border-b border-gray-500 font-bold">Loại kiểm thử</h3>
                    <ul class="mt-4 max-h-80 space-y-4 overflow-y-auto text-left text-gray-500 dark:text-gray-400">
                        @foreach ($listErrorType as $testType)
                            <li class="flex items-center space-x-3">
                                <div class="flex w-[300px] items-center justify-between">
                                    <svg class="h-3.5 w-3.5 flex-shrink-0 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span class="text-black">{{ $testType->typeName }}</span>
                                    <form
                                        action="{{ route('deleteErrorType.projectMember', ['projectID' => $projectID]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="error_type_id" class="hidden"
                                            value="{{ $testType->errorTypeID }}">
                                        <button type="submit" class="hover:cursor-pointer">
                                            <i class="fa-solid fa-trash-can text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- ------------ -->

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
