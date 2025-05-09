<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Online Voting System</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f4f6;
    }

    .notification {
      opacity: 1;
      transition: opacity 0.5s ease-in-out;
      animation: slideIn 0.5s forwards;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .fade-out {
      animation: fadeOut 0.5s forwards;
    }

    @keyframes fadeOut {
      from {
        transform: translateY(0);
        opacity: 1;
      }

      to {
        transform: translateY(-20px);
        opacity: 0;
      }
    }

    .card {
      background-color: white;
      border-radius: 0.5rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .page-content {
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #4f46e5;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #3730a3;
    }
  </style>
</head>

<body>
  <div class="min-h-screen bg-gray-50">
    <!-- Error and Success Messages -->
    <div id="notifications" class="fixed top-4 right-4 z-50 space-y-3 max-w-sm">
      @if ($errors->any())
      <div id="error-notification"
        class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-red-500 rounded shadow-lg">
        <div class="flex-shrink-0 mr-3">
          <i class="fas fa-times-circle text-red-500 text-xl"></i>
        </div>
        <div class="flex-grow">
          <h3 class="font-medium text-gray-800">Error</h3>
          <div class="text-sm text-gray-600 max-h-28 overflow-auto">
            <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <button onclick="closeNotification('error-notification')" class="text-gray-500 hover:text-gray-700 ml-3">
          <i class="fas fa-times"></i>
        </button>
      </div>
      @endif

      @if (session('success'))
      <div id="success-notification"
        class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-green-500 rounded shadow-lg">
        <div class="flex-shrink-0 mr-3">
          <i class="fas fa-check-circle text-green-500 text-xl"></i>
        </div>
        <div class="flex-grow">
          <h3 class="font-medium text-gray-800">Success</h3>
          <p class="text-sm text-gray-600">{{ session('success') }}</p>
        </div>
        <button onclick="closeNotification('success-notification')" class="text-gray-500 hover:text-gray-700 ml-3">
          <i class="fas fa-times"></i>
        </button>
      </div>
      @endif

      @if (session('error'))
      <div id="session-error-notification"
        class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-red-500 rounded shadow-lg">
        <div class="flex-shrink-0 mr-3">
          <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
        </div>
        <div class="flex-grow">
          <h3 class="font-medium text-gray-800">Error</h3>
          <p class="text-sm text-gray-600">{{ session('error') }}</p>
        </div>
        <button onclick="closeNotification('session-error-notification')"
          class="text-gray-500 hover:text-gray-700 ml-3">
          <i class="fas fa-times"></i>
        </button>
      </div>
      @endif
    </div>

    <!-- Page Heading -->
    <div class="min-h-screen flex flex-col">
      <!-- New Navbar -->
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

      <div class="flex flex-1">
        <!-- New Sidebar -->
        <aside id="sidebar"
          class="bg-gradient-to-b from-indigo-900 to-blue-800 w-1/2 md:w-1/6 lg:w-1/6 border-r border-indigo-700 hidden md:block lg:block shadow-lg transition-all duration-300">
          <!-- Logo Section -->
          <div class="flex justify-center items-center py-6 border-b border-indigo-700 bg-indigo-900/30">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-24 filter drop-shadow-lg">
          </div>

          @php
          $user = Auth::user();
          @endphp

          <ul class="list-reset flex flex-col">
            @if (App\Models\Watcher::where('user_id', $user->id)->exists())
            <li
              class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('userwatchers.index') ? 'bg-indigo-700' : '' }}">
              <a href="{{ route('userwatchers.index') }}"
                class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
                <div class="flex items-center">
                  <i class="fas fa-vote-yea text-indigo-300 mr-3"></i>
                  <span>Elections</span>
                </div>
                <i class="fas fa-angle-right opacity-70"></i>
              </a>
            </li>
            @endif
          </ul>
        </aside>

        <!-- Main Content -->
        <main class="bg-gray-50 flex-1 p-6 overflow-auto">
          <div class="page-content">
            <div class="container mx-auto">
              <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Elections Dashboard</h1>
                <p class="text-gray-600">Monitor voting activity in real-time for elections you're assigned to watch.
                </p>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($watchers as $watcher)
                <div
                  class="card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                  <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-4 py-4 border-b">
                    <h3 class="text-xl font-semibold text-white">{{ $watcher->election->name }}</h3>
                    <div class="flex items-center mt-1">
                      <span
                        class="{{ $watcher->election->is_active ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-700' }} text-xs px-2 py-1 rounded-full font-medium">
                        {{ $watcher->election->is_active ? 'Active' : 'Inactive' }}
                      </span>
                    </div>
                  </div>

                  <div class="p-4">
                    <div class="flex justify-between items-center mb-4">
                      <div class="text-gray-600 flex items-center">
                        <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                        <span>{{ $watcher->election->voting_start ? \Carbon\Carbon::parse($watcher->election->voting_start)->format('M d, Y') : 'Date not set' }}</span>
                      </div>
                    </div>

                    @if($watcher->election->is_active)
                    <div class="mb-5 bg-blue-50 border-l-4 border-blue-500 rounded-r p-4">
                      <div class="flex items-center">
                        <i class="fas fa-clock text-blue-600 mr-2"></i>
                        <h4 class="text-sm font-semibold text-blue-800">Voting Ends In:</h4>
                      </div>
                      <div id="timer-{{ $watcher->election->id }}" class="text-lg font-bold text-blue-700 mt-1"
                        data-end="{{ $watcher->election->voting_end_timestamp }}">
                        {{ $watcher->election->time_remaining }}
                      </div>
                    </div>
                    @endif

                    <div>
                      <div class="flex items-center mb-3">
                        <i class="fas fa-chart-bar text-indigo-600 mr-2"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Live Vote Results</h3>
                      </div>
                      <div id="nominees-{{ $watcher->election->id }}" class="space-y-4">
                        <div class="text-center py-6">
                          <div
                            class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-600">
                          </div>
                          <p class="mt-2 text-gray-600">Loading nominees and votes...</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                <div class="col-span-full">
                  <div class="bg-white rounded-lg p-6 text-center border-2 border-dashed border-gray-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
                      <i class="fas fa-eye-slash text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">No Assigned Elections</h3>
                    <p class="text-gray-600">You're not assigned as a watcher for any elections.</p>
                  </div>
                </div>
                @endforelse
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

  <script>
    // Function to toggle sidebar
    function sidebarToggle() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }

    // Profile dropdown toggle function
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

    // Auto-hide notifications after 5 seconds
    setTimeout(function () {
      const notifications = document.querySelectorAll('.notification');
      notifications.forEach(notification => {
        notification.classList.add('fade-out');
        setTimeout(() => {
          notification.style.display = 'none';
        }, 500);
      });
    }, 5000);

    // Close notification function
    function closeNotification(id) {
      const notification = document.getElementById(id);
      notification.classList.add('fade-out');
      setTimeout(() => {
        notification.style.display = 'none';
      }, 500);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const watchers = @json($watchers);

      // Initialize vote count fetching for each election
      watchers.forEach(watcher => {
        // Get the election ID from the watcher object
        const electionId = watcher.election?.id;
        if (electionId) {
          fetchVotes(electionId);

          // Set interval to refresh vote counts every 3 seconds
          setInterval(() => {
            fetchVotes(electionId);
          }, 3000);
        }

        // Set up countdown timer for active elections
        if (watcher.election && watcher.election.is_active) {
          const timerElement = document.getElementById(`timer-${watcher.election.id}`);
          if (timerElement) {
            const endTimestamp = parseInt(timerElement.getAttribute('data-end')) * 1000; // Convert to milliseconds

            // Update timer immediately and then every second
            updateTimer(timerElement, endTimestamp);
            setInterval(() => updateTimer(timerElement, endTimestamp), 1000);
          }
        }
      });

      function updateTimer(element, endTimestamp) {
        const now = new Date().getTime();
        const timeLeft = endTimestamp - now;

        if (timeLeft <= 0) {
          element.innerHTML = "Voting has ended";
          element.parentElement.classList.remove('bg-blue-50', 'border-blue-500');
          element.parentElement.classList.add('bg-red-50', 'border-red-500');
          element.classList.remove('text-blue-700');
          element.classList.add('text-red-700');
          return;
        }

        // Calculate days, hours, minutes and seconds
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Display the result
        let timeString = '';

        if (days > 0) {
          timeString += `${days}d `;
        }
        if (hours > 0 || days > 0) {
          timeString += `${hours}h `;
        }
        if (minutes > 0 || hours > 0 || days > 0) {
          timeString += `${minutes}m `;
        }
        timeString += `${seconds}s`;

        element.innerHTML = timeString;
      }

      function fetchVotes(electionId) {
        fetch(`/userwatchers/${electionId}`)
          .then(response => {
            return response.json();
          })
          .then(data => {
            updateVotesDisplay(electionId, data);
          })
          .catch(error => {
            console.error('Error fetching vote counts:', error);
          });
      }

      function updateVotesDisplay(electionId, nominees) {
        const container = document.getElementById(`nominees-${electionId}`);

        if (!nominees.length) {
          container.innerHTML = '<div class="text-center py-4 bg-gray-50 rounded-lg border border-gray-200"><p class="text-gray-500">No nominees found for this election.</p></div>';
          return;
        }

        // Group nominees by position
        const positionGroups = {};
        nominees.forEach(nominee => {
          if (!positionGroups[nominee.position]) {
            positionGroups[nominee.position] = [];
          }
          positionGroups[nominee.position].push(nominee);
        });

        // Generate HTML for each position and its nominees
        let html = '';
        for (const position in positionGroups) {
          html += `
            <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:mb-0 last:pb-0">
              <div class="flex items-center mb-3">
                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded">Position</span>
                <h4 class="font-medium text-gray-800 ml-2">${position}</h4>
              </div>
              <div class="mt-3 space-y-3">
          `;

          // Sort nominees by vote count (descending)
          const sortedNominees = positionGroups[position].sort((a, b) => b.vote_count - a.vote_count);

          sortedNominees.forEach((nominee, index) => {
            // Calculate percentage for progress bar
            const maxVotes = Math.max(...sortedNominees.map(n => n.vote_count)) || 1;
            const percentage = (nominee.vote_count / maxVotes) * 100;

            // Different colors based on position (1st, 2nd, 3rd, etc)
            let barColor = 'bg-gray-400';
            if (index === 0) barColor = 'bg-indigo-600';
            else if (index === 1) barColor = 'bg-blue-500';
            else if (index === 2) barColor = 'bg-purple-500';

            html += `
              <div class="nominee-item">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-sm font-medium ${index === 0 ? 'text-indigo-800' : 'text-gray-700'}">${nominee.name}</span>
                  <span class="text-sm font-bold ${index === 0 ? 'text-indigo-800' : 'text-gray-700'}">${nominee.vote_count} votes</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                  <div class="${barColor} h-2.5 rounded-full transition-all duration-500 ease-out" 
                      style="width: ${percentage}%">
                  </div>
                </div>
              </div>
            `;
          });

          html += `
              </div>
            </div>
          `;
        }

        container.innerHTML = html;
      }
    });
  </script>
</body>

</html>