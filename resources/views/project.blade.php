@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Project
            <span class="mt-2 block text-xs font-normal text-gray-300">
                <a href="/">Home</a> &raquo;
                <a href="#">Projects</a> &raquo;
            </span>
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
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required></textarea>
                            <label for="description"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Mô
                                tả dự án</label>
                        </div>

                        <div class="modal-action">
                            <button class="btn" type="submit">Lưu thông tin</button>
                        </div>
                    </form>

                    {{-- <div class="modal-action">
                        <form method="dialog">
                            <button class="btn">Close</button>
                            <button class="btn">Save</button>
                        </form>
                    </div> --}}
                </div>
            </dialog>


            {{-- List du an --}}

            <div>
                @if (count($projects) > 0)
                    <div class="flex flex-wrap">
                        @foreach ($projects as $project)
                            <div class="card m-4 w-96 bg-base-100 shadow-xl">
                                {{-- <a href="#"> --}}
                                <div class="card-body p-3">
                                    <div class="flex items-center justify-between">
                                        <h2 class="card-title">{{ $project->projectName }}</h2>
                                        <div class="dropdown m-1">
                                            <label tabindex="0" class="">
                                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 16 3">
                                                    <path
                                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                                </svg>
                                            </label>
                                            <ul tabindex="0"
                                                class="menu dropdown-content rounded-box z-[1] w-52 bg-base-100 p-2 shadow">
                                                <li><a>Xem chi tiết</a></li>
                                                <li><a>Xóa dự án</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="whitespace-wrap h-[150px] overflow-y-clip text-justify">
                                        {{ $project->description }}</p>
                                    <a href="{{ route('projects.show', ['id' => $project->projectID]) }}">Xem chi tiết</a>
                                </div>
                                {{-- </a> --}}
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Hiện chưa có dự án nào.</p>
                @endif
            </div>

        </div>
    </main>
@endsection
