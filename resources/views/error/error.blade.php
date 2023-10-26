@extends('layout')

@section('content')
    <main class="relative mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Quản lý task
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/projects">Dự án</a></li>
                    <li><a href="/projects/{{ $project->projectID }}">{{ $project->projectID }}</a></li>
                    <li>Quản lý task</li>
                </ul>
            </div>
        </div>


        <div class="">
            <button class="btn btn-neutral btn-sm ml-4" onclick="modalAddError.showModal()">Thêm lỗi</button>
            <dialog id="modalAddError" class="modal">
                <div class="modal-box">
                    <h3 class="mb-4 text-lg font-bold">Thêm lỗi</h3>
                    <form method="dialog">
                        <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                    </form>
                    <form action="{{ route('error.store', ['projectID' => $projectID]) }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <!--                    ------------------------body-------------------------->
                        <input value="{{ $projectID }}" name="projectID" hidden>
                        <div class="h-[400px] overflow-auto pr-2">
                            <div class="group relative z-0 mb-3 mt-3 w-full">
                                <input type="text" name="errorName" id="errorName"
                                    class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                    placeholder=" " required />
                                <label for="errorName"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Tên
                                    lỗi</label>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <textarea name="description" id="description"
                                    class="peer block h-28 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                    placeholder=" " required></textarea>
                                <label for="description"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Mô
                                    tả lỗi</label>
                            </div>


                            <div class="group relative z-0 mb-6 flex w-full flex-row">
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Người xử lý</span>
                                    </label>
                                    <select class="select select-bordered w-[440px]" name="assignedTo">
                                        <option disabled selected>---Chọn---</option>
                                        @foreach ($project->members as $option)
                                            <option value="{{ $option->user->userID }}">
                                                <div>{{ $option->user->lastName . ' ' . $option->user->firstName }}</div>
                                                <div> - {{ $option->user->email }}</div>
                                                <div> - {{ $option->role }}</div>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="group relative z-0 mb-6 flex w-full flex-row">
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Báo cáo cho</span>
                                    </label>
                                    <select class="select select-bordered w-[440px]" name="reporter">
                                        <option disabled selected>---Chọn---</option>
                                        @foreach ($project->members as $option)
                                            <option value="{{ $option->user->userID }}">
                                                <div>{{ $option->user->lastName . ' ' . $option->user->firstName }}</div>
                                                <div class="text-red-200"> - {{ $option->user->email }}</div>
                                                <div class="text-red-200"> - {{ $option->role }}</div>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="group relative z-0 mb-6 flex w-full flex-row">
                                <div class="form-control mr-2 w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Loại kiểm thử</span>
                                    </label>
                                    <select class="select select-bordered" name="testTypeID">
                                        <option disabled selected>---Chọn---</option>
                                        @foreach ($project->testTypes as $option)
                                            <option value="{{ $option->testTypeID }}">{{ $option->typeName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-control ml-2 w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Loại lỗi</span>
                                    </label>
                                    <select class="select select-bordered" name="errorTypeID">
                                        <option disabled selected>---Chọn---</option>
                                        @foreach ($project->errorTypes as $option)
                                            <option value="{{ $option->errorTypeID }}">{{ $option->typeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <div class="form-control w-full w-full">
                                    <label class="label">
                                        <span class="label-text">Thời gian hoàn thành</span>
                                    </label>
                                    <input type="datetime-local" name="estimateTime" placeholder="Chọn ngày và giờ"
                                        class="z-100 rounded border p-2">
                                </div>
                            </div>


                            <div class="group relative z-0 mb-6 w-full">
                                <div class="form-control w-full w-full">
                                    <label class="label">
                                        <span class="label-text">Mức độ ưu tiên</span>
                                    </label>
                                    <select class="select select-bordered" name="priority">
                                        <option disabled selected>---Chọn---</option>
                                        <option value="4">Nghiêm trọng</option>
                                        <option value="3">Cao</option>
                                        <option value="2">Trung bình</option>
                                        <option value="1">Thấp</option>
                                    </select>
                                </div>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <textarea name="stepsToReproduce" id="description"
                                    class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                    placeholder=" " required></textarea>
                                <label for="description"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                    Các bước mô tả lỗi</label>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <textarea name="expectedResult" id="description"
                                    class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                    placeholder=" " required></textarea>
                                <label for="description"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                    Kết quả mong đợi</label>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <textarea name="actualResult" id="description"
                                    class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                    placeholder=" " required></textarea>
                                <label for="description"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                    Kết quả thực tế</label>
                            </div>

                            <div class="group relative z-0 mb-6 w-full">
                                <div class="flex w-full items-center justify-center">
                                    <label for="dropzone-file"
                                        class="dark:hover-bg-bray-800 dark-bg-gray-700 hover-bg-gray-100 dark-border-gray-600 dark-hover-border-gray-500 dark-hover-bg-gray-600 flex h-[100px] w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
                                        <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                            <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Thêm các minh chứng về lỗi</span> hoặc kéo thả
                                                vào
                                                đây</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG </p>
                                        </div>
                                        <input id="dropzone-file" name="files[]" type="file" accept="image/*"
                                            class="hidden" multiple />
                                    </label>
                                </div>
                                <div>
                                    <div id="selected-images" class="flex flex-wrap gap-4"></div>
                                </div>
                            </div>

                        </div>
                        <!--                    ------------------------body-------------------------->

                        <div class="modal-action">
                            <button class="btn" type="submit">Tạo</button>
                    </form>
                    <form method="dialog">
                        <button class="btn">Hủy</button>
                    </form>
                </div>


        </div>
        </dialog>
        </div>

        <div class="grid h-[500px] grid-cols-5 overflow-auto">
            <div class="col-span-1 m-2">
                <div class="card rounded-box flex h-full flex-col bg-red-200 p-2">
                    <div class="break-normal font-bold">ERROR</div>
                    @foreach ($listError as $error)
                        @include('error.error-card', ['error' => $error, 'typeError' => 'ERROR'])
                    @endforeach
                </div>
            </div>

            <div class="col-span-1 m-2">
                <div class="rounded-box flex h-full flex-grow flex-col border bg-yellow-200 p-2">
                    <div class="break-normal font-bold">PENDING</div>
                    @foreach ($listPending as $error)
                        @include('error.error-card', ['error' => $error, 'typeError' => 'PENDING'])
                    @endforeach
                </div>
            </div>
            <div class="col-span-1 m-2">
                <div class="card rounded-box flex h-full flex-grow flex-col border bg-base-300 bg-green-200 p-2">
                    <div class="break-normal font-bold">TESTED</div>
                    <div class="flex flex-col space-y-2">
                        @foreach ($listTested as $error)
                            @include('error.error-card', ['error' => $error, 'typeError' => 'TESTED'])
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-span-1 m-2">
                <div class="card rounded-box flex h-full flex-grow flex-col border bg-blue-200 p-2">
                    <div class="break-normal font-bold">CLOSED</div>
                    @foreach ($listClosed as $error)
                        @include('error.error-card', ['error' => $error, 'typeError' => 'CLOSED'])
                    @endforeach
                </div>
            </div>
            <div class="col-span-1 m-2">
                <div class="card rounded-box flex h-full flex-grow flex-col border bg-gray-200 p-2">
                    <div class="break-normal font-bold">CANCEL</div>
                    @foreach ($listCancel as $error)
                        @include('error.error-card', ['error' => $error, 'typeError' => 'CANCEL'])
                    @endforeach
                </div>
            </div>


        </div>
        @if ($detailsError)
            <div class="absolute top-0 h-full w-full bg-gray-500 bg-opacity-10 backdrop-blur-[1px]">
                <div class="flex h-full w-full items-center justify-center">
                    <div class="relative z-50 h-[620px] w-[1000px] rounded-[20px] bg-white p-10">
                        <a class="absolute right-5 top-5 text-4xl text-gray-500 hover:text-red-500"
                            href="{{ route('error.index', ['projectID' => $projectID]) }}">&times;</a>

                        <!-- Phần Title -->
                        <div class="mb-4">
                            <h1 class="text-2xl font-semibold">{{ $detailsError->errorName }}</h1>
                        </div>
                        <!-- Phần Body -->
                        <div class="mb-6 w-full overflow-auto">

                            <form action="{{ route('error.store', ['projectID' => $projectID]) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <!--                    ------------------------body-------------------------->
                                <input value="{{ $projectID }}" name="projectID" hidden>
                                <div class="h-[460px] overflow-auto pr-2">
                                    <div class="group relative z-0 mb-3 mt-3 w-full">
                                        <input @if ($role == 'Developer') readonly @endif type="text"
                                            name="errorName" id="errorName" value="{{ $detailsError->errorName }}"
                                            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                            placeholder=" " required />
                                        <label for="errorName"
                                            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Tên
                                            lỗi</label>
                                    </div>

                                    <div class="group relative z-0 mb-6 w-full">
                                        <textarea name="description" id="description" @if ($role == 'Developer') readonly @endif
                                            class="peer block h-28 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                            placeholder=" " required readonly>{{ $detailsError->description }}</textarea>
                                        <label for="description"
                                            class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Mô
                                            tả lỗi</label>
                                    </div>


                                    <div class="group relative z-0 mb-6 flex w-full flex-row">
                                        <div class="form-control w-full max-w-xs">
                                            <label class="label">
                                                <span class="label-text">Người xử lý</span>
                                            </label>
                                            <select class="select select-bordered w-[440px]" name="assignedTo">
                                                @foreach ($project->members as $option)
                                                    <option value="{{ $option->user->userID }}"
                                                        @if ($option->user->userID === $detailsError->assignedTo) selected @endif>
                                                        <div>{{ $option->user->lastName . ' ' . $option->user->firstName }}
                                                        </div>
                                                        <div> - {{ $option->user->email }}</div>
                                                        <div> - {{ $option->role }}</div>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="group relative z-0 mb-6 flex w-full flex-row">
                                        <div class="form-control w-full max-w-xs">
                                            <label class="label">
                                                <span class="label-text">Báo cáo cho</span>
                                            </label>
                                            <select class="select select-bordered w-[440px]" name="reporter">
                                                <option disabled selected>---Chọn---</option>
                                                @foreach ($project->members as $option)
                                                    <option value="{{ $option->user->userID }}"
                                                        @if ($option->user->userID === $detailsError->reporter) selected @endif>
                                                        <div>{{ $option->user->lastName . ' ' . $option->user->firstName }}
                                                        </div>
                                                        <div class="text-red-200"> - {{ $option->user->email }}</div>
                                                        <div class="text-red-200"> - {{ $option->role }}</div>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="group relative z-0 mb-6 flex w-full flex-row">
                                        <div class="form-control mr-2 w-full max-w-xs">
                                            <label class="label">
                                                <span class="label-text">Loại kiểm thử</span>
                                            </label>
                                            <select class="select select-bordered" name="testTypeID">
                                                <option disabled selected>---Chọn---</option>
                                                @foreach ($project->testTypes as $option)
                                                    <option value="{{ $option->testTypeID }}"
                                                        @if ($option->testTypeID === $detailsError->testTypeID) selected @endif>
                                                        {{ $option->typeName }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-control ml-2 w-full max-w-xs">
                                            <label class="label">
                                                <span class="label-text">Loại lỗi</span>
                                            </label>
                                            <select class="select select-bordered" name="errorTypeID">
                                                <option disabled selected>---Chọn---</option>
                                                @foreach ($project->errorTypes as $option)
                                                    <option value="{{ $option->errorTypeID }}"
                                                        @if ($option->errorTypeID === $detailsError->errorTypeID) selected @endif>
                                                        {{ $option->typeName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="group relative z-0 mb-6 w-full">
                                        <div class="form-control w-full w-full">
                                            <label class="label">
                                                <span class="label-text">Thời gian hoàn thành</span>
                                            </label>
                                            <input value="{{ $detailsError->estimateTime }}" type="datetime-local"
                                                name="estimateTime" placeholder="Chọn ngày và giờ"
                                                class="z-100 rounded border p-2"
                                                value="{{ $detailsError->errorName }}>
                                </div>
                            </div>


                            <div class="group
                                                relative z-0 mb-6 w-full">
                                            <div class="form-control w-full w-full">
                                                <label class="label">
                                                    <span class="label-text">Mức độ ưu tiên</span>
                                                </label>
                                                <select class="select select-bordered" name="priority">
                                                    <option value="4"
                                                        @if ($option->priority === $detailsError->priority) selected @endif>Nghiêm trọng
                                                    </option>
                                                    <option value="3"
                                                        @if ($option->priority === $detailsError->priority) selected @endif>Cao</option>
                                                    <option value="2"
                                                        @if ($option->priority === $detailsError->priority) selected @endif>Trung bình
                                                    </option>
                                                    <option value="1"
                                                        @if ($option->priority === $detailsError->priority) selected @endif>Thấp</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="group relative z-0 mb-6 mt-4 w-full">
                                            <textarea name="stepsToReproduce" id="stepsToReproduce" @if ($role == 'Developer') readonly @endif
                                                class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                                placeholder=" " required>{{ $detailsError->stepsToReproduce }}</textarea>
                                            <label for="description"
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                                Các bước mô tả lỗi</label>
                                        </div>

                                        <div class="group relative z-0 mb-6 w-full">
                                            <textarea name="expectedResult" id="expectedResult" @if ($role == 'Developer') readonly @endif
                                                class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                                placeholder=" " required>{{ $detailsError->expectedResult }}</textarea>
                                            <label for="description"
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                                Kết quả mong đợi</label>
                                        </div>

                                        <div class="group relative z-0 mb-6 w-full">
                                            <textarea name="actualResult" id="actualResult" @if ($role == 'Developer') readonly @endif
                                                class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                                placeholder=" " required>{{ $detailsError->actualResult }}</textarea>
                                            <label for="description"
                                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                                Kết quả thực tế</label>
                                        </div>

                                        <div class="flex flex-row flex-wrap">
                                            @foreach ($detailsError->images as $image)
                                                <div class="w-[200px]">
                                                    <img class="" src="{{ asset('storage/' . $image->imagePath) }}"
                                                        alt="Profile picture" width="100%">
                                                </div>
                                            @endforeach
                                        </div>


                                        <input type="submit"
                                            class="my-4 cursor-pointer rounded-md bg-blue-500 px-4 py-2 text-white"
                                            value="Cập nhật">
                            </form>
                            <h3 class="mt-6 text-blue-400">Comment</h3>
                            <div class="mb-6 h-[300px] w-full overflow-auto rounded-lg border border-gray-500">
                                @foreach ($detailsError->comments as $comment)
                                    <div class="">
                                        <div class="flex gap-3 px-6 py-3 font-normal text-gray-900">
                                            <div class="relative h-8 w-8">
                                                @if ($comment->user->urlImage)
                                                    <img id="avatar" class="mx-auto h-full w-full rounded-full"
                                                        src="{{ asset('storage/' . $comment->user->urlImage) }}"
                                                        alt="Profile picture">
                                                @else
                                                    <img id="avatar" class="mx-auto h-full w-full rounded-full"
                                                        src="https://fastcharger.info/images/avatar-placeholder.png"
                                                        alt="Profile picture">
                                                @endif


                                            </div>
                                            <div class="text-[10px]">
                                                <div class="font-medium text-gray-700">
                                                    {{ $comment->user->lastName . ' ' . $comment->user->firstName }}
                                                </div>
                                                <div class="text-gray-400">{{ $comment->user->email }}</div>
                                            </div>
                                            <br />
                                            <span class="text-[10px] text-gray-400">{{ $comment->created_at }}</span>
                                        </div>
                                        <p class="pl-6 text-[12px]">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <form action="{{ route('error.sendComment', ['projectID' => $project->projectID]) }}"
                                method="post">
                                @csrf
                                <div class="group relative z-0 mb-6 mt-6 w-full">
                                    <textarea name="comment" id="expectedResult" required
                                        class="peer block h-16 w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"></textarea>
                                    <label for="description"
                                        class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">
                                        Comment</label>
                                </div>
                                <input type="text" class="hidden" value="{{ $detailsError->errorID }}"
                                    name="error_id">
                                <button class="btn">
                                    <span>Send comment <i class="fa-solid fa-paper-plane"></i></span>
                                </button>
                            </form>
                        </div>
                        <!-- Đây là nội dung body của bạn -->
                    </div>
                    <!-- Phần Footer -->
                    <div class="flex justify-end p-4">

                        <a class="ml-2 rounded-md bg-red-500 px-4 py-2 text-white"
                            href="{{ route('error.index', ['projectID' => $projectID]) }}">Hủy</a>

                    </div>
                </div>
            </div>
            </div>
        @endif


    </main>

    <script src="{{ Vite::asset('resources/js/toastify.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize the datetime picker
        flatpickr('#estimateTime', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            appendTo: document.getElementById('modalAddError')
        });


        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error'))
                showToastify('{{ session('error') }}', "red");
            @elseif (session('success')) showToastify('{{ session('success') }}', "green");
            @endif
        });

        // Get references to the file input and the selected images container
        const fileInput = document.getElementById('dropzone-file');
        const selectedImagesContainer = document.getElementById('selected-images');
        let selectedImages = [];

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                for (const file of fileInput.files) {
                    if (file.type.startsWith('image/')) {
                        const imageContainer = document.createElement('div');
                        imageContainer.classList.add('relative');

                        const image = document.createElement('img');
                        image.src = URL.createObjectURL(file);
                        image.alt = 'Selected Image';
                        image.classList.add('max-h-32', 'max-w-32');

                        const removeButton = document.createElement('button');
                        removeButton.innerHTML = 'X';
                        removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                            'rounded-full', 'text-xs', 'w-4', 'h-4', 'flex', 'items-center', 'justify-center',
                            'cursor-pointer', 'hover:bg-red-600');

                        removeButton.addEventListener('click', function() {
                            // Remove the selected image from the selectedImages array
                            const index = selectedImages.indexOf(file);
                            if (index !== -1) {
                                selectedImages.splice(index, 1);
                            }

                            selectedImagesContainer.removeChild(imageContainer);
                        });

                        imageContainer.appendChild(image);
                        imageContainer.appendChild(removeButton);
                        selectedImagesContainer.appendChild(imageContainer);
                        selectedImages.push(file);
                    }
                }
            }
        });
    </script>
@endsection
