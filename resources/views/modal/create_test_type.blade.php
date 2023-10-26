<div class="z-50">
    <button id="openModal" class="btn btn-neutral btn-sm ml-4">
        Tạo loại kiểm thử
    </button>

    <!-- Modal -->
    <div id="modal" class="fixed left-0 top-0 flex hidden h-full w-full items-center justify-center">
        <div class="modal-overlay absolute h-full w-full bg-gray-900 opacity-50"></div>

        <div class="modal-container z-50 mx-auto w-11/12 overflow-y-auto rounded bg-white shadow-lg md:max-w-md">
            <!-- Modal content -->
            <div class="modal-content px-6 py-4 text-left">
                <!-- Title -->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl font-bold">Loại kiểm thử</p>
                    <div id="closeModal" class="modal-close z-50 cursor-pointer">
                        <svg class="fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M5.293 5.293a1 1 0 011.414 0L9 7.586l2.293-2.293a1 1 0 111.414 1.414L10.414 9l2.293 2.293a1 1 0 01-1.414 1.414L9 10.414 6.707 12.707a1 1 0 01-1.414-1.414L7.586 9 5.293 6.707a1 1 0 010-1.414z" />
                        </svg>
                    </div>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('handleCreateTestType.projects', ['projectID' => $projectID]) }}" method="post">
                    @csrf
                    <div>
                        <div class="z-0 mb-6 w-full">
                            <input type="text" name="test_type"
                                class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-black dark:focus:border-blue-500"
                                required />
                        </div>
                        <input type="text" name="projectID" value="{{ $projectID }}" class="hidden">

                    </div>

                    <!-- Modal Actions -->
                    <div class="flex justify-end pt-2">

                        <button id="saveButton" class="modal-save btn btn-active btn-sm ml-4" type="submit">Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to control the modal
    const openModal1Button = document.getElementById("openModal");
    const modal = document.getElementById("modal");
    const closeModalButton = document.getElementById("closeModal");
    const saveButton = document.getElementById("saveButton");
    const closeButton = document.getElementById("closeButton");

    openModal1Button.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    closeModalButton.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    saveButton.addEventListener("click", () => {
        // Perform your save action here
    });

    closeButton.addEventListener("click", () => {
        modal.classList.add("hidden");
    });
</script>
