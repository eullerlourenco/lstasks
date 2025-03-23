@extends('layouts.auth')

@section('page-title', 'Login >')

@section('content')
    <section class="relative flex">
        <div class="bg-neutral-900 w-full lg:w-1/3 h-screen">
            <div class="h-full flex flex-col align-center justify-around">
                <div class="text-center">
                    <x-general.logo width="210px" name="logo-header" />
                </div>
                <div>
                    <h2 class="text-3xl text-neutral-200 text-center font-normal">Log in to access ;)</h2>
                </div>
                @session('status')
                    <div class="text-lime-400 text-center">
                        {{ $value }}
                    </div>
                @endsession
                <div>
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col items-center w-full w-1/3-sm px-5">
                            <div class="max-w-[320px] w-full">
                                <x-forms.input-group type="text" id="email" name="email"
                                    placeholder="youremail@email.com" label="Email" icon="fa-solid fa-envelope" />
                                <x-forms.input-group type="text" id="password" name="password" placeholder="Password"
                                    label="Password" type="password" icon="fa-solid fa-lock" />
                                <button class="btn-primary my-8 w-full" type="submit">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    Sign in
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="flex flex-col text-center text-md text-neutral-600 gap-y-1">
                    <a class="duration-200 ease-in hover:text-lime-400 mb-2" href="{{ route('password.request') }}">I forgot
                        my
                        password</a>
                    <p class="duration-200 ease-in">
                        is not registered?
                        <a class="text-lime-500 hover:text-lime-400 transition-200 ease-in" href="{{ route('register') }}">
                            Create an account
                        </a>
                    </p>
                </div>
            </div>

        </div>
        <div class="hidden lg:flex flex-col items-center flex-grow justify-center text-center">
            <p class="text-white font-bold text-7xl">CHALLENGE</p>
            <p class="text-gradient font-bold text-7xl">YOURSELF</p>
            <p class="text-white font-light tracking-widest text-xl mt-3">Be an organized and creative person</p>
        </div>
    </section>
@endsection
