<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index()
    {


        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('is_done')
            ->defaultSort('created_at')
            ->allowedSorts(['title', 'is_done'])
            ->paginate();
        return new TaskCollection($tasks);
    }

    public function show(Request $request, Task $task)
    {
        return new TaskResource($task);
    }

    public function store(TaskStoreRequest $request)
    {
        $validate = $request->validated();
       // $task = Task::create($validate);
       $task=Auth::user()->tasks()->create( $validate);
    }
    public function Update(Request $request, Task $task)
    {
        $validated = $request->validate(['title' => 'sometimes|required', 'is_done' => 'required']);
        $task->update($validated);
        return new TaskResource($task);
    }
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
