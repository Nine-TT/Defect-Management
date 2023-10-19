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

                @yield('content')
            </div>
        </div>

    </body>

</html>
