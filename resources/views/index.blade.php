@extends ('layouts.app')

@section('title', 'List of Tasks')


@section('content')

    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}"
            class="font-medium text-blue-500 underline decoration-none hover:text-blue-900">Add Task</a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>{{ $task->title }}

            </a>
        </div>
    @empty
        <div>There are no Tasks</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
