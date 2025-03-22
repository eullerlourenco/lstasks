@extends('layouts.default')

@section('page-title', 'Profile >')

@section('content')
    <div class="grid grid-cols-5 gap-6">

        <x-general.container class="col-span-5 md:col-span-2">
            <x-users.form-edit-user :user="$user" />
        </x-general.container>
        <x-general.container class="col-span-5 md:col-span-3">
            <x-tasks.user-tasks-achievements />
        </x-general.container>
    </div>
@endsection
