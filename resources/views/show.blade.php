@extends('layouts.app')

@section('title', $task->title)


@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.index') }}"
            class="font-medium text-blue-500 underline decoration-none hover:text-blue-900">◀Back to Task List</a>
    </nav>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">Created: {{ $task->created_at->diffForHumans() }} ⚫
        Updated: {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        @if ($task->completed)
        <span class="text-green-500">✅ Completed</span>
            
        @else
          <span class="text-red-500">❌ Not Completed</span>
        @endif
    </p>

    <div class="flex space-x-3">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
            class="btn"
            >Edit</a>
        <form method="POST" action="{{ route('tasks.complete', ['task' => $task->id]) }}">
            @csrf
            @method('PUT')
            <button class="btn" type="submit">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>
 
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Delete</button>
        </form>
    </div>
@endsection
