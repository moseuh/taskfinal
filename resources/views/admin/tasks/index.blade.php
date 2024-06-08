@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Tasks</h1>
    <div class="row">
        @foreach ($tasks as $task)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text">{{ $task->description }}</p>
                        <p class="card-text">Deadline: {{ $task->deadline }}</p>
                        <p class="card-text">Status: {{ $task->status }}</p>
                        <form method="POST" action="{{ route('admin.tasks.destroy', $task) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
