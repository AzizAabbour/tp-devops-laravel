<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * Get all tasks for the authenticated user.
     */
    public function getAllForUser()
    {
        return Auth::user()->tasks()->latest()->paginate(10);
    }

    /**
     * Create a new task.
     */
    public function createTask(array $data)
    {
        return Auth::user()->tasks()->create($data);
    }

    /**
     * Update an existing task.
     */
    public function updateTask(Task $task, array $data)
    {
        // Ensure the task belongs to the user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update($data);
        return $task;
    }

    /**
     * Delete a task.
     */
    public function deleteTask(Task $task)
    {
        // Ensure the task belongs to the user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return $task->delete();
    }
}
