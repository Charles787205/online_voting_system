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
    @if ($user->is_admin)
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('users.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('users.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-users text-indigo-300 mr-3"></i>
          <span>Users</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('elections.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('elections.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-vote-yea text-indigo-300 mr-3"></i>
          <span>Elections</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('nominees.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('nominees.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-user-tie text-indigo-300 mr-3"></i>
          <span>Nominees</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('positions.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('positions.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-briefcase text-indigo-300 mr-3"></i>
          <span>Positions</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('watchers.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{route('watchers.index')}}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-eye text-indigo-300 mr-3"></i>
          <span>Watchers</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('votes.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('votes.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-check-circle text-indigo-300 mr-3"></i>
          <span>Votes</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('archives.index') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('archives.index') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-archive text-indigo-300 mr-3"></i>
          <span>Archives</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    @elseif (App\Models\Watcher::where('user_id', $user->id)->exists())
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
    @else
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('student.elections') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('student.elections') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-vote-yea text-indigo-300 mr-3"></i>
          <span>Elections</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    <li
      class="w-full h-full border-b border-indigo-700/50 {{ request()->routeIs('student.vote') ? 'bg-indigo-700' : '' }}">
      <a href="{{ route('student.vote') }}"
        class="font-medium flex items-center justify-between py-3 px-4 hover:bg-indigo-700/70 transition-all duration-200 text-white/90 hover:text-white">
        <div class="flex items-center">
          <i class="fas fa-check-circle text-indigo-300 mr-3"></i>
          <span>Vote</span>
        </div>
        <i class="fas fa-angle-right opacity-70"></i>
      </a>
    </li>
    @endif
  </ul>

</aside>