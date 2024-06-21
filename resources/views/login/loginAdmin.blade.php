@extends("index")

@section('main-body')
<div class="content-center h-screen">
  <div class="relative max-w-md py-36 px-16 mx-auto outline outline-2 outline-amber-500 rounded-2xl">
    @if (session()->has('login_error'))
    <div id="login_alert" class="absolute top-10 right-0 p-4 mb-4 font-semibold text-sm max-w-sm bg-red-800 text-white rounded-s-2xl flex items-center" role="alert">
        {{ session('login_error') }}
        <button type="button" class="ms-3 -mx-1.5 -my-1.5 text-white rounded-full hover:bg-white hover:text-red-800 p-1.5 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#login_alert" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
    </div>
    @endif
    <form class="max-w-sm mx-auto" href="/login-adm" method="POST">
      @csrf
      <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 placeholder-gray-700 text-gray-700 @error('email') is-invalid @enderror" placeholder="name@gmail.com" required value="admin@gmail.com" />
      </div>
      @error('email')
        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
          {{ $message }}
        </div>
      @enderror
      <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
        <input type="password" id="password" name="password" class="bg-gray-50 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 placeholder-gray-700 text-gray-700 @error('password') is-invalid @enderror" required value="admin"/>
      </div>
      @error('password')
        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
          {{ $message }}
        </div>
      @enderror
      <div class="flex justify-center w-full">
        <button type="submit" class="mt-8 text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login as Admin</button>
      </div>
    </form>
  </div>
</div>

@endsection
