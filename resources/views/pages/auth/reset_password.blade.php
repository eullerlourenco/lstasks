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
            <div class="mb-3">
                <h2 class="text-2xl text-neutral-200 text-center font-normal">Change your password</h2>
            </div>
            <div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="flex flex-col items-center w-full w-1/3-sm px-5">
                        <div class="max-w-[320px] w-full">
                            <x-forms.input-group type="text" id="email" name="email"
                                placeholder="youremail@email.com" label="Email" icon="fa-solid fa-envelope"
                                :default-value="request()->email" />
                            <input type="hidden" name="token" value="{{ request()->token }}">
                            <x-forms.input-group type="text" id="password" name="password" placeholder="New password"
                                label="New password" type="password" icon="fa-solid fa-lock" />
                            <x-forms.input-group type="text" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat password" label="Password confirmation" type="password"
                                icon="fa-solid fa-lock" />
                            <button class="btn-primary my-8 w-full" type="submit">
                                <i class="fa-solid fa-arrow-right me-1"></i>
                                Reset password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
