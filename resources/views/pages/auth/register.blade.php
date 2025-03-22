@extends('layouts.auth')

@section('page-title', 'Register >')

@section('content')
    <section class="flex">
        <div class="bg-neutral-900 py-8 w-full lg:w-1/3">
            <div class="h-full flex flex-col align-center justify-center">
                <div class="text-center mb-20">
                    <a href="{{ route('tasks.index') }}" class="text-gradient duration-200 ease-in text-5xl font-bold">
                        {{ config('app.name') }}
                    </a>
                </div>
                <div class="mb-7">
                    <h2 class="text-4xl text-neutral-200 text-center font-normal">Create an account</h2>
                </div>
                <div>
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col items-center w-full w-1/3-sm px-5">

                            <div class="max-w-[320px] w-full">
                                <x-forms.input-group type="text" id="name" name="name" placeholder="Jonh Smith"
                                    label="Your Name" icon="fa-solid fa-user" />

                                <x-forms.input-group type="text" id="email" name="email"
                                    placeholder="youremail@email.com" label="Email" icon="fa-solid fa-envelope" />

                                <x-forms.input-group type="text" id="password" name="password" placeholder="Password"
                                    label="Password" type="password" icon="fa-solid fa-lock" />

                                <x-forms.input-group id="password_confirmation" name="password_confirmation"
                                    placeholder="Password confirmation" label="Repeat password" type="password" icon="fa-solid fa-lock" />

                                <button class="btn-primary my-8 w-full" type="submit">
                                    <i class="fa-solid fa-plus"></i>
                                    Create
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="flex flex-col text-center text-md text-neutral-600 gap-y-1">
                    <a class="duration-200 ease-in hover:text-lime-400" href="{{ route('login') }}">I already have an
                        account</a>
                </div>
            </div>

        </div>
        <div class="hidden lg:flex flex-col items-center flex-grow justify-center text-center">
            <p class="text-white font-bold text-7xl">YOUR ARE</p>
            <p class="text-gradient-secondary font-bold text-7xl">ALMOST THERE</p>
            <p class="text-white font-light tracking-widest text-xl mt-3">Be an organized and creative person</p>
        </div>
    </section>
@endsection
