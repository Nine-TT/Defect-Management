@vite('resources/css/app.css')

<section class="" style="background-image: none; background-size: cover; background-repeat: no-repeat; background-attachment: fixed; width: 100%; height: 100vh;" >
    <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0" style="width: 500px ;opacity: 0.9;">
        <a href="#" class="mb-6 flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="mr-2 h-16 w-16" src="https://cdn.discordapp.com/attachments/953496613878399026/1165023769551700078/logo_phenikaa_bugs_master.png?ex=654557ef&is=6532e2ef&hm=5c9bf5a363badbee958fac10b1b24632725cbf06475e0e1a5c23a0c53c93fb88&" alt="logo">
            Phenikaa Bugs Master
        </a>
        <div
            class="w-full rounded-lg bg-white shadow dark:border dark:border-gray-700 dark:bg-gray-800 sm:max-w-md md:mt-0 xl:p-0">
            <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                    Đăng nhập
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Emaill</label>
                        <input type="email" name="email" id="email"
                            class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            placeholder="Nhập email của bạn" required>
                    </div>
                    <div>
                        <label for="password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            required>
                    </div>

                    @if ($errors->get('email'))
                    <div class="flex items-center w-full">
                        <p class="text-sm text-red-500	">Sai tài khoản hoặc mật khẩu</p>
                    </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex h-5 items-center">
                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                    class="focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 h-4 w-4 rounded border border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        <a href="#"
                            class="text-primary-600 dark:text-primary-500 text-sm font-medium hover:underline">Quên mật khẩu?</a>
                    </div>

                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">Sign
                        in</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Bạn chưa có tài khoản <a href="register"
                            class="text-primary-600 dark:text-primary-500 font-medium hover:underline">Đăng ký ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
