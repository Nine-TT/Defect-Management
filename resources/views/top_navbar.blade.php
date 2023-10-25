 <!-- Top navbar -->
 <nav class="sticky top-0 z-50 w-full bg-gray-800 text-black shadow-xl" x-data="{ mobilemenue: false }">
     <div class="mx-auto">
         <div class="flex h-16 items-stretch justify-between">

             <div class="flex items-center md:hidden">
                 <div class="-mr-2 flex" x-data>
                     <!-- Mobile menu button -->
                     <button type="button" @click="$dispatch('togglesidebar')"
                         class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                         aria-controls="mobile-menu" aria-expanded="false">
                         <span class="sr-only">Open main menu</span>

                         <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M4 6h16M4 12h16M4 18h16" />
                         </svg>

                         <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>
             </div>

             <div class="flex items-center pl-6">
                 <div class="flex-shrink-0 md:hidden">

                     <a href="#" class="group flex items-center space-x-2 text-white">
                         <div>
                             <svg class="h-8 w-8 transition-transform duration-300 group-hover:-rotate-45"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                             </svg>
                         </div>

                         <div>
                             <span class="text-2xl font-extrabold">FARNOUS</span>
                             <span class="block text-xs">Project Managment</span>
                         </div>
                     </a>
                 </div>

                 <!-- toggel sidebar -->
                 <div class="hidden cursor-pointer text-white md:block" @click="$dispatch('togglesidebar')">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M4 6h16M4 12h16M4 18h7" />
                     </svg>
                 </div>

                 <div class="hidden lg:block">
                     <!-- Search -->
                     <form action="" class="app-search" method="GET">
                         <div class="group relative">
                             <input type="text"
                                 class="form-input ml-5 w-48 rounded-md border-none border-transparent bg-gray-700 py-1.5 pl-10 text-sm text-gray-300 outline-none transition-all duration-300 ease-in-out focus:w-60 focus:text-white focus:ring-0"
                                 placeholder="Search..." autocomplete="off">
                             <span
                                 class="absolute bottom-2 left-44 text-gray-400 transition-all duration-300 ease-in-out group-focus-within:left-8">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                 </svg>
                             </span>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="hidden items-stretch md:flex">
                 <!-- Profile Menu DT -->
                 <div class="ml-4 flex md:ml-6">
                     <div class="relative mr-4 flex items-center justify-center">
                         <div class="block rounded-full bg-gray-700 p-1 text-gray-400 hover:text-white">
                             <span class="sr-only">View notifications</span>
                             <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                             </svg>
                         </div>
                     </div>

                     <!-- Profile dropdown -->
                     <div class="relative cursor-pointer bg-gray-700 px-4 text-sm text-gray-400 hover:text-white"
                         x-data="{ open: false }">
                         <div class="flex min-h-full items-center" @click="open = !open">

                             <div class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                 id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                 <span class="sr-only">Open user menu</span>
                                 <img class="h-8 w-8 rounded-full"
                                     src="https://assets.codepen.io/3321250/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1646800353&width=512"
                                     alt="">
                             </div>

                             <div class="ml-4 flex flex-col">
                                 <span>{{ $user->lastName??""}} {{$user->firstName??""}}</span>
                             </div>
                         </div>

                         <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-0 min-w-full origin-top-right rounded-b-md bg-white py-1 shadow ring-1 ring-black ring-opacity-5 focus:outline-none"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95" role="menu"
                             aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                             <form method="GET" action="{{ route('profile.edit') }}">
                                 @csrf
                                 <a href="#" :href="route('profile.edit')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1" id="user-menu-item-1">Thông tin cá nhân</a>
                             </form>

                             <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <a href="#" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem" tabindex="-1" id="user-menu-item-1">Đăng xuất</a>
                             </form>

                         </div>
                     </div>

                 </div>
             </div>

             <div class="-mr-2 flex md:hidden">
                 <!-- Mobile menu button -->
                 <button type="button" @click="mobilemenue = !mobilemenue"
                     class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                     aria-controls="mobile-menu" aria-expanded="false">
                     <span class="sr-only">Open main menu</span>

                     <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M4 6h16M4 12h16M4 18h16" />
                     </svg>
                     <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M6 18L18 6M6 6l12 12" />
                     </svg>
                 </button>
             </div>
         </div>
     </div>

     <!-- Mobile menu, show/hide based on menu state. -->
     <div class="absolute w-full bg-gray-800 md:hidden" id="mobile-menu" x-show="mobilemenue"
         x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         @click.away="mobilemenue = false

                ">
         <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
             <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                 aria-current="page">Dashboard</a>

             <a href="#"
                 class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
         </div>

         <div class="border-t border-gray-700 pb-3 pt-4">
             <!-- profile menue for mobile -->
             <div class="flex items-center px-5">
                 <div class="flex-shrink-0">
                     <img class="h-10 w-10 rounded-full"
                         src="https://assets.codepen.io/3321250/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1646800353&width=512"
                         alt="">
                 </div>
                 <div class="ml-3">
                     <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                     <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                 </div>
                 <button type="button"
                     class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                     <span class="sr-only">View notifications</span>
                     <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                     </svg>
                 </button>

             </div>
             <div class="mt-3 space-y-1 px-2">
                 <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                     Profile</a>

                 <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                     out</a>
             </div>
         </div>
     </div>
 </nav>
 <!-- End Top navbar -->
