@vite('resources/css/app.css')

<section class=""
         style="background-image: none; background-size: cover; background-repeat: no-repeat; background-attachment: fixed; width: 100%; height: 100vh;">
    <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0"
         style="width: 900px ;opacity: 0.9;">
        <a href="#" class="mb-6 flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="mr-2 h-16 w-16"
                 src="https://cdn.discordapp.com/attachments/953496613878399026/1165023769551700078/logo_phenikaa_bugs_master.png?ex=654557ef&is=6532e2ef&hm=5c9bf5a363badbee958fac10b1b24632725cbf06475e0e1a5c23a0c53c93fb88&"
                 alt="logo">
            Phenikaa Bugs Master
        </a>
        <div
            class="w-full rounded-lg bg-white shadow dark:border dark:border-gray-700 dark:bg-gray-800 sm:max-w-md md:mt-0 xl:p-0">
            <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                    Đăng ký tài khoản
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="lastName" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Họ
                                đệm</label>
                            <input type="text" name="lastName" id="lastName"
                                   class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                                   placeholder="Họ và tên đệm" required>
                        </div>
                        <div>
                            <label for="firstName" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Tên</label>
                            <input type="text" name="firstName" id="firstName"
                                   class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                                   placeholder="Nhập tên của bạn" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="lastName" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Ngày
                                sinh</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input datepicker name="birthday" datepicker-autohide type="date"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 input-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Select date">
                            </div>
                        </div>

                        <div>
                            <label for="gender" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Giới
                                tính</label>
                            <select required name="gender"
                                    class="select select-ghost focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm">
                                <option disabled selected>Chọn giới tính</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                            @if ($errors->get('gender'))
                            <p class="text-sm text-red-500	">Vui lòng chọn giới tính</p>
                            @endif
                        </div>

                    </div>
                    <div>
                        <label for="email"
                               class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Emaill</label>
                        <input type="email" name="email" id="email"
                               class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                               placeholder="Nhập email của bạn" required>
                        @if ($errors->get('email'))
                        <p class="text-sm text-red-500	">Email này đã được sử dụng</p>
                        @endif
                    </div>
                    <div>
                        <label for="password"
                               class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                               class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                               required>
                        @if ($errors->get('password'))
                        <p class="text-sm text-red-500	"> Mật khẩu ít nhất 8 ký tự gồm 1 chữ thường, 1 chữ hoa và 1 chữ số</p>
                        @endif
                    </div>

                    <div>
                        <label for="password_confirmation"
                               class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nhập lại mật
                            khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="••••••••"
                               class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                               required>
                        @if ($errors->get('password_confirmation'))
                        <p class="text-sm text-red-500	">Mật khẩu nhập lại phải giống với mật khẩu đã nhập</p>
                        @endif
                    </div>

                    <button type="submit"
                            class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                        Sign
                        in
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Bạn đã có tài khoản <a href="login"
                                               class="text-primary-600 dark:text-primary-500 font-medium hover:underline">
                            Đăng nhập ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
