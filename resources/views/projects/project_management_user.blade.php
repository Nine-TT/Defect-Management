@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Quản lý thành viên
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/projects">Dự án</a></li>
                    <li><a href="/projects/{{ $projectID }}">{{ $projectID }}</a></li>
                    <li>Thành viên</li>
                </ul>
            </div>
        </div>



        <div class="m-5">
            <button class="btn btn-neutral btn-sm ml-4" onclick="my_modal_1.showModal()">Thêm thành viên</button>

            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <h3 class="mb-4 text-lg font-bold">Thêm thành viên</h3>
                    <form method="dialog">
                        <button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2">✕</button>
                    </form>

                    <form action="{{ route('handle-add-user.handleAddMemberToProject') }}" method="POST">
                        @csrf
                        <input type="text" class="hidden" value="{{ $projectID }}" name="projectID">
                        <div class="group relative z-0 mb-6 w-full">
                            <input type="text" name="user_email" id="user_email"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required />
                            <label for="user_email"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Email</label>
                        </div>

                        <div class="group form-control relative z-0 mb-6 w-full max-w-xs">
                            <label class="label">
                                <span class="label-text">Vai trò</span>
                            </label>
                            <select name="role" class="select select-bordered">
                                <option>Admin</option>
                                <option>Developer</option>
                                <option selected>Tester</option>
                            </select>
                        </div>

                        <div class="modal-action">
                            <button class="btn" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </dialog>
        </div>

        <div>

            <div class="m-5 h-[450px] overflow-hidden overflow-y-auto rounded-lg border border-gray-700 shadow-md">
                <table class="w-full border-collapse overflow-y-auto bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">State</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                            @if ($roleCheck == true)
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @foreach ($listUser as $key => $users)
                            <tr class="hover:bg-gray-50">
                                <th class="flex gap-3 px-6 py-3 font-normal text-gray-900">
                                    <div class="relative h-10 w-10">
                                        <img class="h-full w-full rounded-full object-cover object-center"
                                            src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="" />
                                        <span
                                            class="absolute bottom-0 right-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">
                                            {{ $users['user']->lastName . ' ' . $users['user']->firstName }}</div>
                                        <div class="text-gray-400">{{ $users['user']->email }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $users['user']->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                            {{ $users['role'] }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($roleCheck == true)
                                        <div class="flex justify-end gap-4">
                                            <form
                                                action="{{ route('handelDeleteUser.projectMember', ['projectID' => $projectID]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="user_id" class="hidden"
                                                    value="{{ $users['user']->userID }}">
                                                <input type="text" name="projectID" class="hidden"
                                                    value="{{ $projectID }}">
                                                <button type="submit" class="btn">
                                                    <a x-data="{ tooltip: 'Delete' }">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="h-6 w-6" x-tooltip="tooltip">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </a>
                                                </button>
                                            </form>

                                            <!-- The button to open modal -->
                                            <label for="my_modal_STT{{ $users['user']->userID }}" class="btn">
                                                <a x-data="{ tooltip: 'Edite' }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                </a></label>

                                            <!-- Put this part before </body> tag -->
                                            <input type="checkbox" id="my_modal_STT{{ $users['user']->userID }}"
                                                class="modal-toggle" />
                                            <div class="modal">
                                                <div class="modal-box">
                                                    <h3 class="text-lg font-bold">Thay đổi role</h3>
                                                    <form
                                                        action="{{ route('handleChangeRole.projectMember', ['projectID' => $projectID]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="text" class="hidden" value="{{ $projectID }}"
                                                            name="projectID">
                                                        <input type="text" class="hidden"
                                                            value="{{ $users['user']->userID }}" name="user_id">
                                                        <div class="group relative z-0 mb-6 w-full">
                                                            <input type="text" name="user_email" id="user_email"
                                                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                                                value="{{ $users['user']->email }}" readonly />

                                                        </div>

                                                        <div class="group form-control relative z-0 mb-6 w-full max-w-xs">
                                                            <label class="label">
                                                                <span class="label-text">Vai trò</span>
                                                            </label>
                                                            <select name="role" class="select select-bordered">
                                                                @foreach (['Admin' => 'Admin', 'Developer' => 'Developer', 'Tester' => 'Tester'] as $value => $label)
                                                                    <option value="{{ $value }}"
                                                                        @if ($value === $users['role']) selected @endif>
                                                                        {{ $label }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="modal-action">
                                                            <button class="btn" type="submit">Xác nhận</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <label class="modal-backdrop"
                                                    for="my_modal_STT{{ $users['user']->userID }}">Close</label>
                                            </div>

                                        </div>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>



    </main>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('myComponent', () => ({
                searchTerm: '',

                filterUsers() {
                    let term = this.searchTerm.toLowerCase();
                    let rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        let userName = row.querySelector('td:nth-child(1)').textContent
                            .toLowerCase();
                        if (userName.includes(term)) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }
            }));
        });
    </script>


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
