<header class="bg-nav">
  <div class="flex justify-between">
    <div class="p-1 mx-3 inline-flex items-center">
      <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
      <h1 class="text-white p-2">Online Voting</h1>
    </div>
    <div class="p-1 flex flex-row items-center">



      <div class="flex relative">

        <a href="#" onclick="profileToggle()"
          class="text-white p-2 no-underline hidden md:block lg:block">{{ Auth::user()->name }}</a>
      </div>
      <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute top-[50px] right-[20px]">
        <ul class="list-reset">
          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">My account</a></li>
          <li><a href="#" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Notifications</a></li>
          <li>
            <hr class="border-t mx-2 border-grey-ligght">
          </li>
          <li><a href="{{ route('logout') }}" class="no-underline px-4 py-2 block text-black hover:bg-grey-light"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>
      </div>
    </div>
  </div>
</header>
<script>
  function profileToggle() {
    const profileDropdown = document.getElementById("ProfileDropDown");
    if (profileDropdown.style.display === "none") {
      profileDropdown.style.display = "block";
    } else {
      profileDropdown.style.display = "none";
    }
  }

</script>