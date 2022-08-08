
 @extends('layouts.guest')

 @section('content')
 <div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
              <h5 class="card-title">Register</h5>
   <!-- Validation Errors -->
   <x-auth-validation-errors class="mb-4" :errors="$errors" />

   <form method="POST" action="{{ route('register') }}">
       @csrf

       <!-- Name -->
       <div>
           <label for="name">{{__('Name')}}</label>

           <input id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{old('name')}}" required autofocus />
       </div>

       <!-- Email Address -->
       <div class="mt-4">
           <label for="email">{{__('Email')}}</label>

           <input id="email" class="form-control block mt-1 w-full" type="email" name="email" value="{{old('email')}}" required />
       </div>

       <!-- Password -->
       <div class="mt-4">
           <label for="password">{{__('Password')}}</label>

           <input id="password" class="form-control block mt-1 w-full"
                           type="password"
                           name="password"
                           required autocomplete="new-password" />
       </div>
       <!-- Confirm Password -->
       <div class="mt-4">
           <label for="password_confirmation">{{__('Confirm Password')}}</label>

           <input id="password_confirmation" class="form-control block mt-1 w-full"
                           type="password"
                           name="password_confirmation" required />
       </div>
<div class="mt-4 mb-5">
    <label for="user_type">Register as</label>
    <select class="form-control" name="user_type" id="user_type">
        <option value="">---Select type---</option>
        <option value="Student">Student</option>
        <option value="Teacher">Teacher</option>
    </select>
</div>
       <button class="btn btn-danger" type="submit">{{ __('Register') }}</button>
       <div class="flex items-center justify-end mt-4">
           <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
               {{ __('Already registered?') }}
           </a>


       </div>
   </form>
            </div>
        </div>
    </div>
 </div>
@endsection
