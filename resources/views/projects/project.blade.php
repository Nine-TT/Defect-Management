@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Dự án
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a>Dự án</a></li>
                </ul>
            </div>
        </div>
        <div>
            <!-- Open the modal using ID.showModal() method -->
            <button class="btn btn-neutral m-4" onclick="my_modal_1.showModal()">Tạo dự án mới</button>

            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <h3 class="mb-4 text-lg font-bold">Thông tin dự án</h3>
                    <form method="dialog">
                        <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                    </form>

                    <form action="projects" method="POST">
                        @csrf
                        <div class="group relative z-0 mb-6 w-full">
                            <input type="text" name="project_name" id="project_name"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required />
                            <label for="project_name"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Tên
                                dự án</label>
                        </div>
                        <input type="text" name="user_id" value="1" class="hidden" />
                        <div class="group relative z-0 mb-6 w-full">
                            <textarea name="description" id="description"
                                class="peer block h-28 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required></textarea>
                            <label for="description"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Mô
                                tả dự án</label>
                        </div>

                        <div class="modal-action">
                            <button class="btn" type="submit">Lưu thông tin</button>
                        </div>
                    </form>
                </div>
            </dialog>


            {{-- List du an --}}

            <div>
                @if (count($projectData) > 0)
                    <div class="flex flex-wrap">
                        @foreach ($projectData as $projectItem)
                            @php
                                $project = $projectItem['project'];
                                $usersCount = $projectItem['usersCount'];
                                $isOpen = $projectItem['isOpen'];
                                $role = $projectItem['userRole'];
                            @endphp
                            <div class="card m-4 w-96 bg-base-100 shadow-xl">
                                <div class="card-body p-5">
                                    <div class="flex items-center justify-between">
                                        <h2 class="card-title pr-1">{{ $project->projectName }}</h2>
                                        <div class="dropdown">
                                            <label tabindex="0" class="hover:cursor-pointer">
                                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>
                                            </label>
                                            <div class="dropdown-left dropdown mb-5">
                                                <ul tabindex="0"
                                                    class="menu dropdown-content rounded-box z-[1] ml-2 w-52 border border-gray-500 bg-base-100 shadow">
                                                    <li><a href="{{ route('projects.show', ['projectID' => $project->projectID]) }}"
                                                            class="">Xem chi tiết</a></li>
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('projects.destroy', ['projectID' => $project->projectID]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"><a>Xóa dự án</a></button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="whitespace-wrap h-[150px] overflow-y-clip border-b border-t p-1 text-justify">
                                        {{ $project->description }}</p>
                                    <div class="flex justify-between">
                                        <div>
                                            <i class="fa-solid fa-user-tie"></i>
                                            <span>{{ $role }}</span>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-users"></i>
                                            <span>{{ $usersCount }}</span>
                                        </div>

                                        <div>
                                            <i class="fa-solid fa-clipboard-check"></i>
                                            <span>{{ $isOpen ? 'Open' : 'Done' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="m-4">Hiện chưa có dự án nào!</p>
                @endif
            </div>


        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                Toastify({
                    text: '{{ session('error') }}',
                    duration: 5000, // Thời gian hiển thị (ms)
                    gravity: 'top', // Vị trí hiển thị (top, bottom, left, right)
                    position: 'center', // Vị trí tương đối (center, left, right)
                    backgroundColor: 'red', // Màu nền
                    stopOnFocus: true, // Dừng hiển thị khi người dùng tập trung vào cửa sổ
                }).showToast();
            @elseif (session('success'))
                Toastify({
                    text: '{{ session('success') }}',
                    duration: 5000, // Thời gian hiển thị (ms)
                    gravity: 'top', // Vị trí hiển thị (top, bottom, left, right)
                    position: 'center', // Vị trí tương đối (center, left, right)
                    backgroundColor: 'green', // Màu nền
                    stopOnFocus: true, // Dừng hiển thị khi người dùng tập trung vào cửa sổ
                }).showToast();
            @endif
        });
    </script>
@endsection
