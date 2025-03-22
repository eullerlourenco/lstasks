@extends('layouts.auth')

@section('page-title', 'Forgot my password >')

@section('content')
    <div class="relative flex items-center justify-center h-screen">
        <div class="bg-neutral-800 rounded-2xl shadow-lg p-5 min-w-[30%]">
            <div class="text-center mb-7">
                <a href="{{ route('tasks.index') }}" class="text-gradient duration-200 ease-in text-5xl font-bold">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="mb-5">
                <h2 class="text-2xl text-neutral-200 text-center font-normal">Request to change your password</h2>
            </div>
            @session('status')
                <div class="text-lime-400 text-center">
                    {{ $value }}
                </div>
            @endsession
            <div>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="flex flex-col items-center w-full w-1/3-sm px-5">
                        <div class="max-w-[320px] w-full">
                            <x-forms.input-group type="text" id="email" name="email"
                                placeholder="youremail@email.com" label="Email" icon="fa-solid fa-envelope" />

                            <button class="btn-primary my-8 w-full" type="submit">
                                <i class="fa-solid fa-arrow-right me-1"></i>
                                Send me the link
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex flex-col text-center text-md text-lime-400 gap-y-1">
                <a class="duration-200 ease-in hover:text-lime-500 mb-2" href="{{ route('login') }}">
                    Back to login
                </a>
            </div>
        </div>
    </div>
@endsection
