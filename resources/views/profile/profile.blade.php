@extends('layout')

@section('content')
    <style>
        .image-container {
            width: 200px;
            height: 200px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        .image-input {
            display: none;
        }
    </style>

    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="mx-auto my-10 rounded-lg bg-white p-5 shadow-md sm:max-w-5xl">
            {{ $errors }}
            @if ($user->urlImage)
                <img id="avatar" class="mx-auto h-32 w-32 rounded-full" src="{{ asset('storage/' . $user->urlImage) }}"
                    alt="Profile picture">
            @else
                <img id="avatar" class="mx-auto h-32 w-32 rounded-full"
                    src="https://fastcharger.info/images/avatar-placeholder.png" alt="Profile picture">
            @endif
            <h2 class="mt-3 text-center text-2xl font-semibold">{{ $user->lastName . ' ' . $user->firstName }}</h2>
            <form method="post" action="{{ route('profile.update') }} " enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 mb-3 mt-3 flex text-center sm:justify-start">
                        <label for="imageInput">
                            <div id="update-button"
                                class="inline cursor-pointer rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                                Cập nhật ảnh đại diện</div>
                            <input type="file" id="imageInput" name="imageInput" class="image-input" accept="image/*">
                        </label>
                        <div id="cancel-button" style="display: none;"
                            class="inline cursor-pointer rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">
                            Hủy</div>
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-900">Họ đệm</label>
                        <input type="text" name="lastName" id="lastName" value="{{ $user->lastName }}"
                            class="input input-bordered w-full" placeholder="Họ và tên đệm" required>
                    </div>
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-900">Tên</label>
                        <input type="text" name="firstName" id="firstName" value="{{ $user->firstName }}"
                            class="input input-bordered w-full" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-900">Ngày sinh</label>
                        <input datepicker name="birthday" datepicker-autohide type="date"
                            class="ck input input-bordered w-full" placeholder="Select date" value="{{ $user->birthday }}">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-900">Giới tính</label>
                        <select required name="gender" class="input select input-bordered select-ghost w-full">
                            <option disabled selected>Chọn giới tính</option>
                            @foreach (['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác'] as $value => $label)
                                <option value="{{ $value }}" @if ($value === $user->gender) selected @endif>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" class="input input-bordered w-full"
                            placeholder="Nhập email của bạn" required value="{{ $user->email }}">
                        @if ($errors->get('email'))
                            <p class="text-sm text-red-500">Email này đã được sử dụng</p>
                        @endif
                    </div>
                </div>
                <div class="m-6 flex justify-center">
                    <input type="submit" class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                        name="update" value="Cập nhật">
                </div>
            </form>
        </div>

        <script src="{{ Vite::asset('resources/js/toastify.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('error'))
                    showToastify('{{ session('error') }}', "red");
                @elseif (session('success'))
                    showToastify('{{ session('success') }}', "green");
                @endif
            });


            var showUpdateAvatarButton = true;

            document.getElementById("imageInput").addEventListener("change", function() {
                const fileInput = this;
                const avatarImage = document.getElementById("avatar");
                const cancelButton = document.getElementById("cancel-button");

                if (fileInput.files && fileInput.files[0]) {
                    // Lấy đường dẫn của tệp ảnh được chọn
                    const imageUrl = URL.createObjectURL(fileInput.files[0]);

                    // Cập nhật ảnh avatar
                    avatarImage.src = imageUrl;

                    // Hiển thị nút "Hủy" và ẩn nút "Cập nhật ảnh"
                    cancelButton.style.display = "block";
                    document.getElementById("imageInput").disable
                    document.getElementById("update-button").style.display = "none";
                }
            });

            // Lắng nghe sự kiện khi nút "Hủy" được nhấn
            document.getElementById("cancel-button").onclick = function() {
                const fileInput = document.getElementById("imageInput");
                const avatarImage = document.getElementById("avatar");
                fileInput.value = "";
                avatarImage.src = "{{ asset('storage/' . $user->urlImage) }}";
                this.style.display = "none";
                document.getElementById("update-button").style.display = "block";
            };
        </script>
    </main>
@endsection
