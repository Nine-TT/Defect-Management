 @php
     $currentRoute = Route::currentRouteName();
 @endphp


 <!-- sidebar -->
 <div class="sidebar fixed inset-y-0 left-0 top-0 z-50 h-screen max-h-screen w-64 transform bg-gray-800 text-blue-100 transition duration-200 ease-in-out"
     x-data="{ open: true }" x-on:togglesidebar.window=" open = !open" x-show="true"
     :class="open === true ? 'md:translate-x-0 md:sticky ' : '-translate-x-full'">

     <header class="top-0 z-40 h-[64px] bg-gray-800 px-4 py-2 shadow-lg md:sticky">
         <!-- logo -->
         <a href="/" class="group flex items-center space-x-2 text-white hover:text-white">
             <div>
                 <img class="h-8 w-8 transition-transform duration-300 group-hover:-rotate-45" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" src="https://f85ec2983f.imgdist.com/public/users/Integrators/BeeProAgency/1078917_1064219/logo_phenikaa_bugs_master.png">
             </div>

             <div>
                 <span class="block text-[15px] font-extrabold">Phenikaa Bug Master</span>
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

             </li>
         </ul>
     </nav>
 </div>
 <!-- End sidebar -->
