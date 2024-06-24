<nav class="bg-none fixed top-0 w-full">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 h-24">
      <a href="/">
        <div class="text-left whitespace-nowrap">
          <h1 class="text-xl text-amber-500 tracking-tight leading-none font-extrabold mb-1">{{ $lastSetting->gym_name }}</h1>
          <h1 class="text-sm text-white">{{ $lastSetting->gym_motto }}</h1>
        </div>
      </a>

      <div class="items-baseline flex w-auto" id="navbar-cta">
        <ul class="flex font-medium rounded-lg space-x-8 rtl:space-x-reverse">
          @if(Auth::user() && Auth::user()->type == "member")
          <li>
            <a href="/join-class" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "Join Class") ? 'border-b-2 border-amber-500' : ''}}">Join Class</a>
          </li>
          <li>
            <a href="#" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "My Class") ? 'border-b-2 border-amber-500' : ''}}">My Class</a>
          </li>
          <li>
            <a href="#" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "Membership") ? 'border-b-2 border-amber-500' : ''}}">Membership</a>
          </li>
          @endif

          @if(Auth::user() && Auth::user()->type == "trainer")
          <li>
            <a href="#" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "My Class") ? 'border-b-2 border-amber-500' : ''}}">My Class</a>
          </li>
          @endif

          @if(Auth::user() && Auth::user()->type == "admin")
          <li>
            <a href="/adm-set-class" class="block py-2 px-4 text-white  hover:text-amber-500 {{ ($title == "Set Class") ? 'border-b-2 border-amber-500' : ''}}">Set Class</a>
          </li>
          <li>
            <a href="/adm-member" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "Member/Trainer") ? 'border-b-2 border-amber-500' : ''}}">Member/Trainer</a>
          </li>
          <li>
            <a href="#" class="block py-2 px-4 text-white hover:text-amber-500 {{ ($title == "Gym Income") ? 'border-b-2 border-amber-500' : ''}}">Gym Income</a>
          </li>
          <li>
            <a href="/inventory" class="block py-2 px-4 text-white  hover:text-amber-500 {{ ($title == "Gym Inventory") ? 'border-b-2 border-amber-500' : ''}}">Gym Inventory</a>
          </li>
          <li>
            <a href="/gym-settings" class="block py-2 px-4 text-white  hover:text-amber-500 {{ ($title == "Gym Settings") ? 'border-b-2 border-amber-500' : ''}}">Gym Settings</a>
          </li>
          @endif

          @auth
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="text-white font-medium rounded-lg text-sm px-4 py-2 text-center bg-amber-500 hover:bg-amber-600">Logout</button>
          </form>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
