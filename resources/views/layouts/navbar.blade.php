<header class="bg-gradient-to-r from-indigo-800 to-blue-700 shadow-lg">
  <div class="flex justify-between items-center px-4">
    <div class="py-3 flex items-center">
      <button class="text-white hover:text-indigo-200 mr-3 transition-all duration-200 focus:outline-none"
        onclick="sidebarToggle()">
        <i class="fas fa-bars text-xl"></i>
      </button>
      <div class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 mr-3 filter drop-shadow-lg">
        <h1 class="text-white font-semibold text-xl tracking-tight">Online Voting System</h1>
      </div>
    </div>

    <div class="flex items-center space-x-4">
      <!-- Notifications Icon -->
      <div class="relative">
        <button class="text-white hover:text-indigo-200 transition-all duration-200 focus:outline-none">
          <i class="fas fa-bell text-lg"></i>
          <span
            class="absolute -top-1 -right-1 bg-red-500 rounded-full text-white text-xs w-4 h-4 flex items-center justify-center">2</span>
        </button>
      </div>

      <!-- User Profile -->
      <div class="relative">
        <button onclick="profileToggle()"
          class="flex items-center space-x-2 text-white hover:text-indigo-200 transition-all duration-200 px-2 py-1 rounded-lg hover:bg-indigo-700/40 focus:outline-none">
          <div
            class="w-8 h-8 rounded-full bg-indigo-300 flex items-center justify-center overflow-hidden border-2 border-white">
            <i class="fas fa-user text-indigo-800"></i>
          </div>
          <span class="hidden md:inline font-medium">{{ Auth::user()->name }}</span>
          <i class="fas fa-chevron-down text-xs"></i>
        </button>

        <!-- Dropdown Menu -->
        <div id="ProfileDropDown"
          class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-50 overflow-hidden transform origin-top-right transition-all duration-200">
          <div class="px-4 py-3 bg-gradient-to-r from-indigo-800 to-blue-700 text-white">
            <p class="text-sm">Logged in as</p>
            <p class="text-sm font-medium truncate">{{ Auth::user()->email }}</p>
          </div>
          <div class="border-t border-gray-100">
            <a href="#"
              class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition duration-150 flex items-center">
              <i class="fas fa-user-circle mr-2 text-indigo-600"></i>
              My Profile
            </a>
            <a href="#"
              class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition duration-150 flex items-center">
              <i class="fas fa-cog mr-2 text-indigo-600"></i>
              Settings
            </a>
            <a href="{{ route('logout') }}"
              class="block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition duration-150 flex items-center"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-2 text-red-600"></i>
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  function profileToggle() {
    const profileDropdown = document.getElementById("ProfileDropDown");
    profileDropdown.classList.toggle("hidden");
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function (event) {
    const dropdown = document.getElementById("ProfileDropDown");
    const profileButton = event.target.closest('[onclick="profileToggle()"]');

    if (!profileButton && !dropdown.contains(event.target) && !dropdown.classList.contains('hidden')) {
      dropdown.classList.add('hidden');
    }
  });
</script>