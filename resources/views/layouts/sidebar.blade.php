<aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

  @php
  $user = Auth::user();
  @endphp

  <ul class="list-reset flex flex-col">
    @if ($user->is_admin)
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('users.index') ? 'bg-white' : '' }}">
      <a href="{{ route('users.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-users float-left mx-2"></i>
        Users
        <span><i class="fas fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('elections.index') ? 'bg-white' : '' }}">
      <a href="{{ route('elections.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-vote-yea float-left mx-2"></i>
        Elections
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('nominees.index') ? 'bg-white' : '' }}">
      <a href="{{ route('nominees.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-user-tie float-left mx-2"></i>
        Nominees
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('positions.index') ? 'bg-white' : '' }}">
      <a href="{{ route('positions.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-briefcase float-left mx-2"></i>
        Positions
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li class="w-full h-full py-3 px-2 border-b border-light-border">
      <a href="{{route('watchers.index')}}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-eye float-left mx-2"></i>
        Watchers
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('votes.index') ? 'bg-white' : '' }}">
      <a href="{{ route('votes.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-check-circle float-left mx-2"></i>
        Votes
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    @else
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('student.elections') ? 'bg-white' : '' }}">
      <a href="{{ route('student.elections') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-vote-yea float-left mx-2"></i>
        Elections
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('student.vote') ? 'bg-white' : '' }}">
      <a href="{{ route('student.vote') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-check-circle float-left mx-2"></i>
        Vote
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('student.nominate') ? 'bg-white' : '' }}">
      <a href="{{ route('student.nominate') }}"
        class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
        <i class="fas fa-user-tie float-left mx-2"></i>
        Nominate
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    @endif
  </ul>

</aside>