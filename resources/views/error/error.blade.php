@extends('layout')

@section('content')
<main class="mb-auto flex-grow bg-[#f3f3f9]">
    {{$errors}}

    <h1>
        {{$projectID}}
    </h1>


    <div>
        <button class="btn btn-neutral btn-sm ml-4" onclick="modalAddError.showModal()">Thêm lỗi</button>
        <dialog id="modalAddError" class="modal ">
            <div class="modal-box ">
                <h3 class="mb-4 text-lg font-bold">Thêm lỗi</h3>
                <form method="dialog">
                    <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                </form>

                <form action="{{ route('error.store',['projectID'=>$projectID])}}" method="POST">
                    @csrf
                    <!--                    ------------------------body-------------------------->
                    <input value="{{$projectID}}" name="projectID" hidden>
                    <div class="h-[400px] pr-2   overflow-auto">
                        <div class="group relative z-0 mb-3 mt-3 w-full">
                            <input type="text" name="errorName" id="errorName"
                                   class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                   placeholder=" " required/>
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


                        <div class="group relative z-0 mb-6 w-full flex flex-row">
                            <div class="form-control w-full max-w-xs ">
                                <label class="label">
                                    <span class="label-text">Người xử lý</span>
                                </label>
                                <select class="select select-bordered w-[440px]" name="assignedTo">
                                    <option disabled selected>---Chọn---</option>
                                    @foreach($project->members as $option)
                                    <option value="{{ $option->user->userID }}">
                                        <div>{{ $option->user->lastName." ".$option->user->firstName }}</div>
                                        <div> - {{ $option->user->email}}</div>
                                        <div> - {{ $option->role}}</div>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="group relative z-0 mb-6 w-full flex flex-row">
                            <div class="form-control w-full  max-w-xs">
                                <label class="label">
                                    <span class="label-text">Báo cáo cho</span>
                                </label>
                                <select class="select select-bordered w-[440px]" name="reporter">
                                    <option disabled selected>---Chọn---</option>
                                    @foreach($project->members as $option)
                                    <option value="{{ $option->user->userID }}">
                                        <div>{{ $option->user->lastName." ".$option->user->firstName }}</div>
                                        <div class="text-red-200 "> - {{ $option->user->email}}</div>
                                        <div class="text-red-200 "> - {{ $option->role}}</div>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="group relative z-0 mb-6 w-full flex flex-row">
                            <div class="form-control w-full max-w-xs mr-2">
                                <label class="label">
                                    <span class="label-text">Loại kiểm thử</span>
                                </label>
                                <select class="select select-bordered" name="testTypeID">
                                    <option disabled selected>---Chọn---</option>
                                    @foreach($project->testTypes as $option)
                                    <option value="{{ $option->testTypeID }}">{{ $option->typeName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-control w-full max-w-xs ml-2">
                                <label class="label">
                                    <span class="label-text">Loại lỗi</span>
                                </label>
                                <select class="select select-bordered" name="errorTypeID">
                                    <option disabled selected>---Chọn---</option>
                                    @foreach($project->errorTypes as $option)
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
                                <input type="text" name="estimateTime" placeholder="Chọn ngày và giờ"
                                       class="border rounded p-2 z-100">
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
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                       class="flex flex-col items-center justify-center w-full h-[100px] border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover-bg-bray-800 dark-bg-gray-700 hover-bg-gray-100 dark-border-gray-600 dark-hover-border-gray-500 dark-hover-bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Thêm các minh chứng về lỗi</span> hoặc kéo thả vào
                                            đây</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG </p>
                                    </div>
                                    <input id="dropzone-file" name="files" type="file" accept="image/*" class="hidden"
                                           multiple/>
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
                    <button class="btn ">Hủy</button>
                </form>
            </div>


    </div>
    </dialog>
    </div>

    <div class="grid grid-cols-5 h-[500px]  overflow-auto">
        <div class="col-span-1 m-2">
            <div class="grid h-full   card bg-red-200 rounded-box p-2 font-bold">
                <div class="break-normal font-bold">ERROR</div>
                @foreach($listError as $error)
                <div class="bg-white border rounded-lg mt-2 mb-2 relative">
                    <!-- Title -->
                    <div class="bg-gray-200 text-bl-500 py-2 px-4 flex justify-between items-center">
                        <p class="text-sm font-semibold">{{$error->errorName}}</p>
                        <!-- Nút "..." -->
                        <div class="relative group">
                            <div class="dropdown dropdown-end">
                                <label tabindex="0"  class="btn bg-gray-200 font-bold border-0 ">. . .</label>
                                <ul tabindex="0" class="dropdown-content z-[9999999999] menu shadow bg-base-100 rounded-box w-52 ">

                                    @foreach(['PENDING', 'TESTED', 'CLOSED','CANCEL'] as $type)
                                    <li p-0>
                                        <form method="post" action="{{ route('error.update',['projectID'=>$projectID])}}" >
                                            @csrf
                                            @method('patch')
                                            <input type="text" value="{{$type}}" name="status" hidden>
                                            <input type="text" value="{{$error->errorID}}" name="errorID" hidden>
                                            <input type="submit"  class="w-40 cursor-pointer" value="{{$type}}">
                                        </form>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="p-4">
                        <p class="text-gray-600">This is the main content of the card.</p>
                    </div>
                    <!-- Footer -->
                    @if($error->assignedToUser)
                    <div class="bg-gray-200 text-gray-700 py-2 px-4 flex justify-center items-center">
                        <div class="tooltip" data-tip="assigned: {{$error->assignedToUser->lastName}} {{$error->assignedToUser->firstName}} ">
                            @if($error->assignedToUser->urlImage)
                            <img id="avatar" class="w-6 h-6 rounded-full mx-auto" src="{{ asset('storage/'.$error->assignedToUser->urlImage) }}"
                                 alt="Profile picture">
                            @else
                            <img  id="avatar" class="w-6 h-6 rounded-full mx-auto" src="https://fastcharger.info/images/avatar-placeholder.png"
                                  alt="Profile picture">
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                @endforeach

            </div>
        </div>

        <div class="col-span-1 m-2">
            <div class="grid h-full  flex-grow bg-yellow-100 rounded-box p-2 border">
                <div class="break-normal font-bold">PENDING</div>

                @foreach($listPending as $error)
                <div class="bg-white border rounded-lg mt-2 mb-2 relative">
                    <!-- Title -->
                    <div class="bg-gray-200 text-bl-500 py-2 px-4 flex justify-between items-center">
                        <p class="text-sm font-semibold">{{$error->errorName}}</p>
                        <!-- Nút "..." -->
                        <div class="relative group">
                            <div class="dropdown dropdown-end">
                                <label tabindex="0"  class="btn bg-gray-200 font-bold border-0 ">. . .</label>
                                <ul tabindex="0" class="dropdown-content z-[9999999999] menu shadow bg-base-100 rounded-box w-52 ">

                                    @foreach(['ERROR', 'TESTED', 'CLOSED','CANCEL'] as $type)
                                    <li p-0>
                                        <form method="post" action="{{ route('error.update',['projectID'=>$projectID])}}" >
                                            @csrf
                                            @method('patch')
                                            <input type="text" value="{{$type}}" name="status" hidden>
                                            <input type="text" value="{{$error->errorID}}" name="errorID" hidden>
                                            <input type="submit"  class="w-40 cursor-pointer" value="{{$type}}">
                                        </form>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="p-4">
                        <p class="text-gray-600">This is the main content of the card.</p>
                    </div>
                    <!-- Footer -->
                    @if($error->assignedToUser)
                    <div class="bg-gray-200 text-gray-700 py-2 px-4 flex justify-center items-center">
                        <div class="tooltip" data-tip="assigned: {{$error->assignedToUser->lastName}} {{$error->assignedToUser->firstName}} ">
                            @if($error->assignedToUser->urlImage)
                            <img id="avatar" class="w-6 h-6 rounded-full mx-auto" src="{{ asset('storage/'.$error->assignedToUser->urlImage) }}"
                                 alt="Profile picture">
                            @else
                            <img  id="avatar" class="w-6 h-6 rounded-full mx-auto" src="https://fastcharger.info/images/avatar-placeholder.png"
                                  alt="Profile picture">
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                @endforeach

            </div>
        </div>
        <div class="col-span-1 m-2">
            <div class="grid h-full flex-grow card bg-blue-100 bg-base-300 rounded-box p-2 border">
                <div class="break-normal font-bold">TESTED</div>
            </div>
        </div>
        <div class="col-span-1 m-2">
            <div class="grid h-full flex-grow card bg-base-300 rounded-box p-2 border">
                <div class="break-normal font-bold">CLOSED</div>
            </div>
        </div>
        <div class="col-span-1 m-2">
            <div class="grid h-full flex-grow card bg-gray-100 rounded-box p-2 border">
                <div class="break-normal font-bold">CANCEL</div>
            </div>
        </div>
    </div>


</main>

<script src="{{ Vite::asset('resources/js/toastify.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialize the datetime picker
    flatpickr('#estimateTime', {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        appendTo: document.getElementById('modalAddError') // Đảm bảo datepicker nằm trong phần tử modalAddError
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    @if(session('error'))showToastify('{{ session('error') }}', "red");
    @elseif(session('success'))showToastify('{{ session('success') }}', "green");
    @endif
    });

    // Get references to the file input and the selected images container
    const fileInput = document.getElementById('dropzone-file');
    const selectedImagesContainer = document.getElementById('selected-images');
    let selectedImages = [];

    // Listen for changes in the file input
    fileInput.addEventListener('change', function () {
        // Check if any files have been selected
        if (fileInput.files.length > 0) {
            // Iterate over the selected files
            for (const file of fileInput.files) {
                // Check if the selected file is an image
                if (file.type.startsWith('image/')) {
                    // Create a container for the image and the remove button
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('relative');

                    // Create a new image element for the selected file
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);
                    image.alt = 'Selected Image';
                    image.classList.add('max-h-32', 'max-w-32');

                    // Create a remove button (X)
                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = 'X';
                    removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white', 'rounded-full', 'text-xs', 'w-4', 'h-4', 'flex', 'items-center', 'justify-center', 'cursor-pointer', 'hover:bg-red-600');

                    // Add a click event listener to the remove button
                    removeButton.addEventListener('click', function () {
                        // Remove the selected image from the selectedImages array
                        const index = selectedImages.indexOf(file);
                        if (index !== -1) {
                            selectedImages.splice(index, 1);
                        }

                        // Remove the image container from the selected images container
                        selectedImagesContainer.removeChild(imageContainer);
                    });

                    // Append the image and the remove button to the image container
                    imageContainer.appendChild(image);
                    imageContainer.appendChild(removeButton);

                    // Append the image container to the selected images container
                    selectedImagesContainer.appendChild(imageContainer);

                    // Store the selected image in the array
                    selectedImages.push(file);
                }
            }
        }
    });
</script>
</script>
@endsection
