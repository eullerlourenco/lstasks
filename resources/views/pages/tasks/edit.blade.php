@extends('layouts.default')

@section('page-title', $task->title . ' >')

@section('content')
    <x-tasks.edit-task-form :task="$task" />
@endsection
