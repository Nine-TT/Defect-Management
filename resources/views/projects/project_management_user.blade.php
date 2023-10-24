@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            <span class="mt-2 block text-xs font-normal text-gray-300">
                <a href="/projects">Projects</a> &raquo;
                <a href="/projects/{{ $projectID }}">{{ $projectID }}</a> &raquo;
                <a href="#">user</a>
            </span>
        </div>

        <div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Role
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($listUser as $key => $users)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                {{ $users['user']->lastName . ' ' . $users['user']->firstName }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $users['user']->email }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $users['role'] }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button
                                    class="focus:shadow-outline-blue rounded-md bg-blue-600 px-4 py-2 font-medium text-white transition duration-150 ease-in-out hover:bg-blue-500 focus:outline-none active:bg-blue-600">Edit</button>
                                <button
                                    class="focus:shadow-outline-red ml-2 rounded-md bg-red-600 px-4 py-2 font-medium text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none active:bg-red-600">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
