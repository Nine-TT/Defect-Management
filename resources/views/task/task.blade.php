@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Quản lý lỗi
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/projects">task</a></li>
                    {{-- <li>{{ $project->projectID }}</li> --}}
                </ul>
            </div>
        </div>

        <div class="mx-auto mt-6 flex h-[510px] w-[96%] justify-between">
            <div class="h-full w-[48%] overflow-auto rounded-lg border-2 border-gray-500">
                <h2 class="sticky top-0 z-10 rounded-lg bg-gray-500 text-center font-bold uppercase">Vai trò developer</h2>
                <div>
                    @foreach ($listTaskAssignedTo as $task)
                        <div class="mx-auto my-4 h-[300px] w-[95%] rounded-lg border border-gray-600">
                            <h2 class="border-b border-gray-400 p-2 font-bold">{{ $task->errorName }}</h2>
                            <a
                                href="{{ route('error.index', ['projectID' => $task->projectID]) }}?error_id={{ $task->errorID }}">
                                <p class="h-[220px] w-full text-ellipsis bg-gray-200 p-2">
                                    {{ $task->description }}
                                </p>
                                <div class="p-2">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <span>{{ $task->status }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="h-full w-[48%] overflow-auto rounded-lg border-2 border-gray-500">
                <h2 class="sticky top-0 z-10 rounded-lg bg-gray-500 text-center font-bold uppercase">Vai trò tester</h2>
                <div>
                    @foreach ($listTaskReporter as $task)
                        <div class="mx-auto my-4 h-[300px] w-[95%] rounded-lg border border-gray-600">
                            <h2 class="border-b border-gray-400 p-2 font-bold">{{ $task->errorName }}</h2>
                            <a
                                href="{{ route('error.index', ['projectID' => $task->projectID]) }}?error_id={{ $task->errorID }}">
                                <p class="h-[220px] w-full text-ellipsis bg-gray-200 p-2">
                                    {{ $task->description }}
                                </p>
                                <div class="p-2">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <span>{{ $task->status }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
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
