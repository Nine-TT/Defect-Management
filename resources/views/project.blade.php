@extends('layout')

@section('content')
    <main class="mb-auto flex-grow bg-[#f3f3f9]">
        <div class="border-b border-gray-300 bg-white py-2 pl-6 text-xl font-bold shadow-sm">
            Project
            <span class="mt-2 block text-xs font-normal text-gray-300">
                <a href="#">Home</a> &raquo;
                <a href="#">Projects</a> &raquo;
                <a href="#">Active</a> &raquo;
                <a href="#">Test</a>
            </span>
        </div>
        <div>
            <!-- Open the modal using ID.showModal() method -->
            <button class="btn" onclick="my_modal_1.showModal()">open modal</button>
            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <div class="group relative z-0 mb-6 w-full">
                            <input type="text" name="project_name" id="project_name"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required />
                            <label for="project_name"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Project
                                name</label>
                        </div>


                        <input type="text" name="user_id" value="1" class="hidden" />



                        <div class="group relative z-0 mb-6 w-full">
                            <textarea name="description" id="description"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                placeholder=" " required></textarea>
                            <label for="description"
                                class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500">Description</label>
                        </div>

                        <div class="modal-action">
                            <button class="btn" type="submit">Save</button>
                        </div>
                    </form>

                    {{-- <div class="modal-action">
                        <form method="dialog">
                            <button class="btn">Close</button>
                            <button class="btn">Save</button>
                        </form>
                    </div> --}}
                </div>
            </dialog>
        </div>
    </main>
@endsection
