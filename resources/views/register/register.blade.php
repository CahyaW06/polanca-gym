@extends("index")

@section('main-body')
<div class="h-fit mx-auto mt-32">
    <div class="mb-4 flex justify-evenly">
        <ul class="flex flex-wrap -mb-px text-xl font-medium text-center" id="register-tab" data-tabs-toggle="#register-tab-content" role="tablist" data-tabs-active-classes="text-amber-500 border-b-2 border-amber-500" data-tabs-inactive-classes="text-white">
            <li class="me-2" role="presentation">
                <button class="p-4 rounded-t-lg" id="user-tab" data-tabs-target="#loginUser" type="button" role="tab" aria-selected="false" aria-controls="loginUser">User</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="p-4 rounded-t-lg" id="trainer-tab" data-tabs-target="#loginTrainer" type="button" role="tab" aria-selected="false" aria-controls="loginTrainer">Trainer</button>
            </li>
        </ul>
    </div>

    <div id="register-tab-content" class="mt-8">

        {{-- Member --}}
        <form class="hidden max-w-sm mx-auto p-4 rounded-lg shadow sm:p-6 md:p-8" href="/register" method="POST" id="loginUser" role="tabpanel" aria-labelledby="user-tab">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('email') is-invalid @enderror" placeholder=" " required />
                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            @error('email')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('password') is-invalid @enderror" placeholder=" " required />
                <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
            </div>
            @error('password')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="repeat_password" id="repeat_password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('repeat_password') is-invalid @enderror" placeholder=" " required />
                <label for="repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
            </div>
            @error('repeat_password')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            <div class="grid md:grid-cols-2 md:gap-6">
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('first_name') is-invalid @enderror" placeholder=" " required />
                  <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('last_name') is-invalid @enderror" placeholder=" " required />
                  <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                </div>
            @error('first_name')
                <div class="alert-danger mb-5 -mt-10 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            @error('last_name')
                <div class="alert-danger mb-5 -mt-10 text-red-400 text-xs">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                  <input id="userValidation" name="userValidation" type="checkbox" value="1" class="w-4 h-4 border rounded focus:ring-3 bg-gray-700 border-gray-600 focus:ring-amber-500 ring-offset-gray-800 focus:ring-offset-gray-800" required />
                </div>
                <label for="userValidation" class="ms-2 text-sm font-medium  text-gray-300">Yes, I want to be a member</label>
            </div>
            <div class="flex items-baseline mb-5 justify-between">
                <button type="submit" class="mt-8 text-white font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600">Submit</button>
                <a href="/login" class="text-sm font-medium  text-gray-400 hover:text-gray-200">Back to login</a>
            </div>
        </form>

        {{-- Trainer Form --}}
        <form class="hidden max-w-4xl mx-auto p-4 rounded-lg shadow sm:p-6 md:p-8" href="/register" enctype="multipart/form-data" method="POST" id="loginTrainer" role="tabpanel" aria-labelledby="trainer-tab">
            @csrf
            <div class="flex gap-16 align-middle">
                <div class="w-1/2">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('email') is-invalid @enderror" placeholder=" " required/>
                        <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                    </div>
                    @error('email')
                        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('password') is-invalid @enderror" placeholder=" " required/>
                        <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    @error('password')
                        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="repeat_password" id="repeat_password" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('repeat_password') is-invalid @enderror" placeholder=" " required />
                        <label for="repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
                    </div>
                    @error('repeat_password')
                        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="grid md:grid-cols-2 md:gap-6">
                      <div class="relative z-0 w-full mb-5 group">
                          <input type="text" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('first_name') is-invalid @enderror" placeholder=" " required/>
                          <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                      </div>
                    @error('first_name')
                        <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                      <div class="relative z-0 w-full mb-5 group">
                          <input type="text" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('last_name') is-invalid @enderror" placeholder=" " required/>
                          <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                      </div>
                    @error('last_name')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label class="block mb-3 text-xs font-medium text-gray-300" for="photo">Pass Photo</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 @error('photo') is-invalid @enderror" aria-describedby="photo_help" id="photo" name="photo" type="file" required>
                        <p class="mt-1 text-xs text-gray-300" id="photo_help">Format file: .jpg, .jpeg</p>
                    </div>
                    @error('photo')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror
                </div>

                <div class="w-1/2">
                    <div class="relative z-0 w-full mb-5 group">
                        <label class="block mb-3 text-xs font-medium text-gray-300" for="apply_letter">Application Letter</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 @error('apply_letter') is-invalid @enderror" aria-describedby="apply_letter_help" id="apply_letter" name="apply_letter" type="file" required>
                        <p class="mt-1 text-xs text-gray-300" id="apply_letter_help">Format file: .pdf</p>
                    </div>
                    @error('apply_letter')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror
                    <div class="relative z-0 w-full mb-5 group">
                        <label class="block mb-3 text-xs font-medium text-gray-300" for="cv">Curriculum Vitae</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 @error('cv') is-invalid @enderror" aria-describedby="cv_help" id="cv" name="cv" type="file" required>
                        <p class="mt-1 text-xs text-gray-300" id="cv_help">Format file: .pdf</p>
                    </div>
                    @error('cv')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror
                    <div class="relative z-0 w-full mb-5 group">
                        <label class="block mb-3 text-xs font-medium text-gray-300" for="certificates">Certificates</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 @error('certificates') is-invalid @enderror" aria-describedby="certificates_help" id="certificates" name="certificates[]" type="file" multiple>
                        <p class="mt-1 text-xs text-gray-300" id="certificates_help">Format file: .pdf</p>
                    </div>
                </div>
            </div>
            <div class="flex items-start mb-5 mt-8">
                <div class="flex items-center h-5">
                  <input id="trainerValidation" name="trainerValidation" type="checkbox" value="1" class="w-4 h-4 border rounded focus:ring-3  bg-gray-700 border-gray-600 focus:ring-amber-500 ring-offset-gray-800 focus:ring-offset-gray-800" required />
                </div>
                <label for="trainerValidation" class="ms-2 text-sm font-medium  text-gray-300">Yes, I want to be a trainer</label>
            </div>
            <div class="flex items-baseline mb-5 justify-between">
                <button type="submit" class="mt-8 text-white font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600">Submit</button>
                <a href="/login" class="text-sm font-medium  text-gray-400 hover:text-gray-200">Back to login</a>
            </div>
        </form>
    </div>
</div>
@endsection
