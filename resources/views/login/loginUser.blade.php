@extends("index")

@section('main-body')
<div class="content-center h-screen">
  @if (session()->has('register_success'))
  <div class="p-4 mb-4 text-sm mx-auto rounded-lg max-w-sm bg-gray-800 text-green-400" role="alert">
      {{ session('register_success') }}
  </div>
  @endif
    <form class="max-w-sm mx-auto">
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
          <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
          <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="flex items-start mb-5">
          <div class="flex items-center h-5">
            <input id="trainerValidation" name="trainerValidation" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
          </div>
          <label for="trainerValidation" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I'm a Trainer</label>
        </div>
        <div class="flex justify-end mb-5 w-full">
          <div class="flex items-center h-5">
            <a href="/register" class="text-sm font-medium text-gray-900 dark:text-gray-400 hover:dark:text-gray-200">Not registered? Register here!</a>
          </div>
        </div>
        <div class="flex justify-center w-full">
          <button type="submit" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </div>
      </form>
</div>

@endsection
