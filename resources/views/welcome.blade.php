<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite('resources/css/app.css')
        @vite('resources/js/navbar.js')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    </head>

    <body>

        <div class="md:flex">


            @include('navbar')

            <!-- content -->
            <div class="flex flex-1 flex-col">

                <!-- Top navbar -->
                @include('top_navbar')
                <!-- Top navbar end -->


                <main class="mb-auto flex-grow bg-[#f3f3f9]">
                    <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
                        TITLE GOES HERE
                        <span class="mt-2 block text-xs font-normal text-gray-300">
                            <a href="#">Home</a> &raquo;
                            <a href="#">Projects</a> &raquo;
                            <a href="#">Active</a> &raquo;
                            <a href="#">Test</a>
                        </span>
                    </div>
                    <div>
                        <!-- -->
                        <div class="min-h-screen bg-gray-100"></div>
                        <div class="min-h-screen bg-gray-100"></div>
                    </div>
                </main>
                <footer class="border-t bg-gray-100 p-4 pb-3 text-xs">
                    2022 © Design & Develop by Farnous.
                </footer>
            </div>

        </div>

    </body>





</html>
