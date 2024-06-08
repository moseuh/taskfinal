@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Tasks</h1>
    <div class="row">
        @if ($tasks === null )
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    No tasks assigned.
                </div>
            </div>
        @else
            @foreach ($tasks as $task)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <p class="card-text">{{ $task->description }}</p>
                            <p class="card-text">Deadline: {{ $task->deadline }}</p>
                            <p class="card-text">Status: {{ $task->status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
