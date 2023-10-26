
<div class="bg-white  rounded-[15px] mt-2 mb-2 relative" style="height: 200px">
    <div style="display: flex; flex-direction: column; height: 100%;">
        <!-- Header -->
        <div class="bg-gray-100 rounded-t-[15px] text-bl-500 px-2 flex justify-between items-center">
            <p class="text-sm font-semibold">{{$error->errorName}}</p>
            <!-- Nút "..." -->
            <div class="relative group">
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn bg-gray-100 font-bold border-0 ">. . .</label>
                    <ul tabindex="0" class="dropdown-content z-[9999999999] menu shadow bg-base-100 rounded-box w-52">
                        @foreach(['ERROR','PENDING', 'TESTED', 'CLOSED','CANCEL'] as $type)
                        @if($type != $typeError)
                        <li p-0>
                            <form method="post" action="{{ route('error.update',['projectID'=>$projectID])}}">
                                @csrf
                                @method('patch')
                                <input type="text" value="{{$type}}" name="status" hidden>
                                <input type="text" value="{{$error->errorID}}" name="errorID" hidden>
                                <input type="submit" class="w-40 cursor-pointer" value="{{$type}}">
                            </form>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Content -->
        <a class="p-4 flex-grow overflow-hidden" href="{{ route('error.index',['projectID'=>$projectID])}}?error_id={{$error->errorID}}">
            <div >
                <div class="text-gray-600 ">{{$error->description}}</div>
            </div>
        </a>

        <!-- Footer -->
        @if($error->assignedToUser)
        <div class="bg-gray-100 rounded-b-[15px] text-gray-700 py-2 px-4 flex justify-center items-center">
            <div class="tooltip" data-tip="assigned: {{$error->assignedToUser->lastName}} {{$error->assignedToUser->firstName}}">
                @if($error->assignedToUser->urlImage)
                <img id="avatar" class="w-6 h-6 rounded-full mx-auto" src="{{ asset('storage/'.$error->assignedToUser->urlImage) }}" alt="Profile picture">
                @else
                <img id="avatar" class="w-6 h-6 rounded-full mx-auto" src="https://fastcharger.info/images/avatar-placeholder.png" alt="Profile picture">
                @endif
            </div>
        </div>
        @endif
    </div>
</div>


