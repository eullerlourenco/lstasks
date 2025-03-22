@extends('layouts.default')
@section('page-title', 'Tasks >')

@section('content')

    <x-general.filter-tasks :filter="$filter" />

    <x-tasks.recurring-list :tasks="$recurringTasks" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-7 gap-x-3" 
    :base-day-for-week="$filter['startDate'] ?? date('Y-m-d')" />

    <x-tasks.tasks-list :tasks="$tasks" />

@endsection
