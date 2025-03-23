@extends('layouts.default')

@section('page-title', $task->limitTitle(30) . ' >')

@section('content')
    <x-tasks.edit-task-form :task="$task" />
@endsection
