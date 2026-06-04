<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Tasks List</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary hover-lift">
                <i class="bi bi-plus-circle me-1"></i> Create Task
            </a>
        </div>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created</th>
                            <th scope="col" class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td class="ps-4">
                                    <h6 class="mb-0 text-white">{{ $task->title }}</h6>
                                    @if($task->description)
                                        <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                            {{ $task->description }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if ($task->status === 'completed')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Completed</span>
                                    @elseif ($task->status === 'in_progress')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">In Progress</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $task->created_at->format('M d, Y') }}</small>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-50">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </div>
                                    No tasks found. Get started by creating a new task!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($tasks->hasPages())
                <div class="card-footer bg-transparent border-top border-secondary border-opacity-10">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
