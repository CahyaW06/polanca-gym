@extends("index")

@section('main-body')
<div class="content-center h-screen">
  @if (session()->has('register_success'))
  <div class="p-4 mb-4 text-sm mx-auto rounded-lg max-w-sm bg-gray-800 text-green-400" role="alert">
      {{ session('register_success') }}
  </div>
  @endif
  @if (session()->has('login_error'))
  <div class="p-4 mb-4 text-sm mx-auto rounded-lg max-w-sm bg-gray-800 text-red-400" role="alert">
      {{ session('login_error') }}
  </div>
  @endif
    <form class="max-w-sm mx-auto" href="/login-adm" method="POST">
      @csrf
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') is-invalid @enderror" placeholder="name@gmail.com" required value="admin@gmail.com" />
        </div>
        @error('email')
          <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
            {{ $message }}
          </div>
        @enderror
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') is-invalid @enderror" required value="admin"/>
        </div>
        @error('email')
          <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
            {{ $message }}
          </div>
        @enderror
        <div class="flex justify-center w-full">
          <button type="submit" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login as Admin</button>
        </div>
      </form>
</div>

@endsection
