<div x-data="{ open: false }" class="relative">
    <!-- Mobile Menu Button -->
    <button @click="open = !open" class="absolute top-4 left-4 z-50 p-2 bg-green-600 text-white rounded-md md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-300 p-4 transform transition-transform duration-300 md:translate-x-0 md:static md:w-64">
        <div class="flex flex-col h-full">
            <!-- Top Section -->
            <div class="flex flex-col flex-grow">
                <!-- Logo Section -->
                <div class="flex flex-col items-center gap-2 mb-8">
                    <div class="flex justify-center items-center gap-2">
                        <img src="{{ asset('images/logupdated.png') }}" class="h-10 w-10 sm:h-12 sm:w-12" alt="Logo 1" />
                        <img src="{{ asset('images/SKSU.jpg') }}" class="h-10 w-10 sm:h-12 sm:w-12" alt="Logo 2" />
                    </div>

                    <!-- User Profile -->
                    <div class="flex flex-col items-center gap-2 mt-4">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-profile.jpg') }}"
                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover" alt="User Profile" />
                        <p class="text-xs sm:text-sm font-bold text-gray-800 text-center">
                            {{ Auth::user()->name }}
                        </p>
                    </div>
                </div>

                <!-- Menu Title -->
                <div class="px-2 mb-2">
                    <h6 class="text-gray-500 text-xs font-semibold tracking-wide uppercase">
                        Menu
                    </h6>
                </div>

                <!-- Menu Links -->
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="AddingFaculty.html"
                            class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-lg bg-green-600 text-white text-xs sm:text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                <path d="M10 9H8" />
                                <path d="M16 13H8" />
                                <path d="M16 17H8" />
                            </svg>
                            <span>Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="OfficeAnnouncement.html"
                            class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-lg hover:bg-green-600 hover:text-white transition text-gray-700 text-xs sm:text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M16 2v4" />
                                <path d="M3 10h18" />
                                <path d="M8 2v4" />
                                <path d="M17 14h-6" />
                                <path d="M13 18H7" />
                                <path d="M7 14h.01" />
                                <path d="M17 18h.01" />
                            </svg>
                            <span>Office File</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left">
                                <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-red-600 hover:text-white">
                                    <div class="h-5 gap-3 flex items-center">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                                              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                              <polyline points="16 17 21 12 16 7"></polyline>
                                              <line x1="21" x2="9" y1="12" y2="12"></line>
                                            </svg>
                                        </div>
                                        <h2 class="text-sm font-medium leading-snug">Log out</h2>
                                    </div>
                                </div>
                            </button>
                        </form>
                    </li>
                </div>
                </ul>

                <!-- Logout Button -->


            <!-- Bottom Section -->
            <div class="mt-6">
                <div class="p-3 sm:p-4 bg-green-50 rounded-2xl flex flex-col items-center text-center gap-2">
                    <div class="flex gap-2">
                        <img src="{{ asset('images/logupdated.png') }}" class="h-5 w-5 sm:h-6 sm:w-6 rounded-full"
                            alt="Logo 1" />
                        <img src="{{ asset('images/SKSU.jpg') }}" class="h-5 w-5 sm:h-6 sm:w-6 rounded-full"
                            alt="Logo 2" />
                    </div>
                    <p class="text-[10px] sm:text-xs font-bold text-gray-600 mt-2 leading-tight">
                        SKSU ISULAN CAMPUS<br />WEB-BASED MANAGEMENT PLATFORM
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
