<div class="w-64 p-2 bg-white h-screen flex-col justify-start items-start gap-5 inline-flex border-r border-gray-400">
    <div class="w-full pt-4 flex flex-col justify-center items-center gap-4">
        <div class="flex justify-center items-center gap-2">
      <img src="{{ asset('images/logupdated.png') }}" class="h-12 w-12" alt="">
      <img src="{{ asset('images/SKSU.jpg') }}" class="h-12 w-12" alt="">
        </div>
      <!-- User Profile -->
      <div class="flex flex-col items-center gap-2 mt-4">
        <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('images/default-profile.jpg') }}"
        class="h-10 w-10 rounded-full object-cover border-2 border-gray-300 hover:scale-105 transition duration-200"
        alt="{{ Auth::user()->name }}" />

        <p class="text-xs sm:text-sm font-bold text-gray-800 text-center">
            {{ Auth::user()->name }}
        </p>
      </div>
    </div>

    <div class="w-full">
      <div class="w-full h-8 px-3 items-center flex">
        <h6 class="text-gray-500 text-xs font-semibold leading-4">MENU</h6>
      </div>
      <ul class="flex-col gap-1 flex">
        <li>
          <a href="{{ route('admin.accout.faculty') }}">
            <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
              <div class="h-5 gap-3 flex">
                <div class="relative">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </div>
                <h2 class="text-sm font-medium leading-snug">
                  Account of Faculty
                </h2>
              </div>
            </div>
          </a>
        </li>
        <li>
            <a href="{{ route('admin.announcement') }}">
              <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
                <div class="h-5 gap-3 flex">
                  <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-megaphone">
                      <path d="m3 11 18-5v12L3 14v-3z"></path>
                      <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"></path>
                    </svg>
                  </div>
                  <h2 class="text-sm font-medium leading-snug">
                    Announcements
                  </h2>
                </div>
              </div>
            </a>
          </li>
        <li>
            <a href="{{ route('school_year.index') }}">
              <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
                <div class="h-5 gap-3 flex">
                  <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-range">
                      <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                      <path d="M16 2v4"></path>
                      <path d="M3 10h18"></path>
                      <path d="M8 2v4"></path>
                      <path d="M17 14h-6"></path>
                      <path d="M13 18H7"></path>
                      <path d="M7 14h.01"></path>
                      <path d="M17 18h.01"></path>
                    </svg>
                  </div>
                  <h2 class="text-sm font-medium leading-snug">
                    School Year &amp; Semester
                  </h2>
                </div>
              </div>
            </a>
          </li>

        <li>
          <a href="{{ route('office.users.index') }}">
            <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
              <div class="h-5 gap-3 flex">
                <div class="relative">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-range">
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M16 2v4"></path>
                    <path d="M3 10h18"></path>
                    <path d="M8 2v4"></path>
                    <path d="M17 14h-6"></path>
                    <path d="M13 18H7"></path>
                    <path d="M7 14h.01"></path>
                    <path d="M17 18h.01"></path>
                  </svg>
                </div>
                <h2 class="text-sm font-medium leading-snug">
                  Main Office/Schedule
                </h2>
              </div>
            </div>
          </a>
        </li>

        <li>
          <a href="Calendar.html">
            <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
              <div class="h-5 gap-3 flex">
                <div class="relative">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-1">
                    <path d="M11 14h1v4"></path>
                    <path d="M16 2v4"></path>
                    <path d="M3 10h18"></path>
                    <path d="M8 2v4"></path>
                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                  </svg>
                </div>
                <h2 class="text-sm font-medium leading-snug">Calendar</h2>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="traceFaculty.html">
            <div class="flex-col flex p-3 bg-white text-gray-700 rounded-lg hover:bg-green-600 hover:text-white">
              <div class="h-5 gap-3 flex">
                <div class="relative">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-navigation">
                    <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                  </svg>
                </div>
                <h2 class="text-sm font-medium leading-snug">
                  Trace Faculty
                </h2>
              </div>
            </div>
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

        <div class="p-6 bg-green-50 rounded-2xl flex-col w-full gap-4 flex">
          <div class="flex-col gap-3 flex">
            <div class="items-center gap-2 inline-flex">
              <img src="{{ asset('images/logupdated.png') }}" alt="Upgrade image" class="h-6 rounded-full">
              <img src="{{ asset('images/SKSU.jpg') }}" alt="Upgrade image" class="h-6 rounded-full">
            </div>
            <div class="mt-2 font-bold text-gray-600">
              SKSU ISULAN CAMPUS WEB-BASED MANAGEMENT PLATFORM
            </div>
          </div>
        </div>

      </ul>
    </div>
  </div>
