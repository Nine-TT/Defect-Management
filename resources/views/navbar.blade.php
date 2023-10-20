 @php
     $currentRoute = Route::currentRouteName();
 @endphp


 <!-- sidebar -->
 <div class="sidebar fixed inset-y-0 left-0 top-0 z-50 h-screen max-h-screen w-64 transform bg-gray-800 text-blue-100 transition duration-200 ease-in-out"
     x-data="{ open: true }" x-on:togglesidebar.window=" open = !open" x-show="true"
     :class="open === true ? 'md:translate-x-0 md:sticky ' : '-translate-x-full'">

     <header class="top-0 z-40 h-[64px] bg-gray-800 px-4 py-2 shadow-lg md:sticky">
         <!-- logo -->
         <a href="#" class="group flex items-center space-x-2 text-white hover:text-white">
             <div>
                 <svg class="h-8 w-8 transition-transform duration-300 group-hover:-rotate-45" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                 </svg>
             </div>

             <div>
                 <span class="text-2xl font-extrabold">FARNOUS</span>
                 <span class="block text-xs">Project Management</span>
             </div>
         </a>
     </header>

     <!-- nav -->
     <nav class="scroller max-h-[calc(100vh-64px)] overflow-y-scroll px-4 pt-4" x-data="{ selected: 'Tasks' }">
         <ul class="flex flex-col space-y-2">

             <!-- ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="{{ route('home') }}"
                     class="{{ $currentRoute === 'home' ? 'bg-white text-black' : '' }} relative flex w-full items-center rounded px-2 py-1 hover:bg-gray-700 hover:text-white">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                         </svg>
                     </div>
                     <div>Dashboard </div>
                 </a>
             </li>

             <!-- Section Devider -->
             <div class="section mb-4 border-b border-gray-700 pb-1 pl-3 pt-4 text-xs text-gray-600">
                 Work
             </div>

             <!-- ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="#"
                     class="relative flex w-full items-center rounded px-2 py-1 hover:bg-gray-700 hover:text-white"
                     x-on:click.prevent="selected = 'Tasks'">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                         </svg>
                     </div>
                     <div>Tasks </div>
                 </a>
             </li>

             <!-- ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="#"
                     class="relative flex w-full items-center rounded px-2 py-1 hover:bg-gray-700 hover:text-white"
                     x-on:click.prevent="selected = 'Errors & Bugs'">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                         </svg>
                     </div>
                     <div>Errors & Bugs </div>
                 </a>
             </li>

             <!-- Section Devider -->
             <div class="section mb-4 border-b border-gray-700 pb-1 pl-3 pt-4 text-xs text-gray-600">
                 Managment
             </div>

             <!-- List ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="#" x-on:click.prevent="selected = (selected === 'Team' ? '':'Team')"
                     class="relative flex w-full items-center rounded px-2 py-1 hover:bg-gray-700 hover:text-white">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                         </svg>
                     </div>
                     <div>Team</div>
                     <div class="absolute right-1.5 transition-transform duration-300"
                         :class="{ 'rotate-180': (selected === 'Team') }">
                         <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                         </svg>
                     </div>
                 </a>

                 <div class="translate max-h-0 transform overflow-hidden pl-4 pr-2 transition-all duration-300"
                     :style="(selected === 'Team') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                     <ul class="mt-2 flex flex-col space-y-1 border-l border-gray-700 pl-2 text-xs text-gray-500">
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Users List </div>
                             </a>
                         </li>
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Create User </div>
                             </a>
                         </li>
                     </ul>
                 </div>
             </li>

             <!-- List ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="{{ url('/projects') }}"
                     class="{{ $currentRoute === 'projects.index' ? 'bg-white text-black' : '' }} hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                         </svg>
                     </div>
                     <div>Projects</div>
                     {{-- <div class="absolute right-1.5 transition-transform duration-300"
                         :class="{ 'rotate-180': (selected === 'Projects') }">
                         <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M19 9l-7 7-7-7" />
                         </svg>
                     </div> --}}
                 </a>

                 {{-- <div class="translate max-h-0 transform overflow-hidden pl-4 pr-2 transition-all duration-300"
                     :style="(selected === 'Projects') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                     <ul class="mt-2 flex flex-col space-y-1 border-l border-gray-700 pl-2 text-xs text-gray-500">
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div>List </div>
                             </a>
                         </li>
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Create Project </div>
                             </a>
                         </li>
                     </ul>
                 </div> --}}
             </li>

             <!-- List ITEM -->
             <li class="text-sm text-gray-500">
                 <a href="#" x-on:click.prevent="selected = (selected === 'Tasks' ? '':'Tasks')"
                     class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                     <div class="pr-2">
                         <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                         </svg>
                     </div>
                     <div>Tasks</div>
                     <div class="absolute right-1.5 transition-transform duration-300"
                         :class="{ 'rotate-180': (selected === 'Tasks') }">
                         <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M19 9l-7 7-7-7" />
                         </svg>
                     </div>
                 </a>

                 <div class="translate max-h-0 transform overflow-hidden pl-4 pr-2 transition-all duration-300"
                     :style="(selected === 'Tasks') ? 'max-height: ' + $el.scrollHeight + 'px': ''">
                     <ul class="mt-2 flex flex-col space-y-1 border-l border-gray-700 pl-2 text-xs text-gray-500">
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div>List </div>
                             </a>
                         </li>
                         <!-- Item -->
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> My tasks </div>
                             </a>
                         </li>
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Create Task </div>
                             </a>
                         </li>

                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Active Task </div>
                             </a>
                         </li>
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> In Progress </div>
                             </a>
                         </li>
                         <li class="text-sm text-gray-500">
                             <a href="#"
                                 class="hover.bg-gray-700 hover.text-white relative flex w-full items-center rounded px-2 py-1">
                                 <div> Closed Task </div>
                             </a>
                         </li>
                     </ul>
                 </div>
             </li>
         </ul>
     </nav>
 </div>
 <!-- End sidebar -->
