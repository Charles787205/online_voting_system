<aside id="sidebar" class="bg-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

  @php
  $user = Auth::user();
  @endphp

  <ul class="list-reset flex flex-col">
    @if ($user->is_admin)
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('users.index') ? 'bg-blue-950' : '' }}">
      <a href="{{ route('users.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-users float-left mx-2"></i>
        Users
        <span><i class="fas fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('elections.index') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('elections.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-vote-yea float-left mx-2"></i>
        Elections
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('nominees.index') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('nominees.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-user-tie float-left mx-2"></i>
        Nominees
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('positions.index') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('positions.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-briefcase float-left mx-2"></i>
        Positions
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li class="w-full h-full py-3 px-2 border-b border-light-border">
      <a href="{{route('watchers.index')}}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-eye float-left mx-2"></i>
        Watchers
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('votes.index') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('votes.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-check-circle float-left mx-2"></i>
        Votes
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('archives.index') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('archives.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-archive float-left mx-2"></i>
        Archives
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    @elseif (App\Models\Watcher::where('user_id', $user->id)->exists())
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('userwatchers.index') ? ' bg-blue-950' : '' }}">
      <a href="{{ route('userwatchers.index') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-vote-yea float-left mx-2"></i>
        Elections
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    @else
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('student.elections') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('student.elections') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-vote-yea float-left mx-2"></i>
        Elections
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>
    <li
      class="w-full h-full py-3 px-2 border-b border-light-border {{ request()->routeIs('student.vote') ? ' bg-blue=-950' : '' }}">
      <a href="{{ route('student.vote') }}"
        class="font-sans font-hairline hover:font-normal text-sm   no-underline text-white">
        <i class="fas fa-check-circle float-left mx-2"></i>
        Vote
        <span><i class="fa fa-angle-right float-right"></i></span>
      </a>
    </li>

    @endif
  </ul>

</aside>