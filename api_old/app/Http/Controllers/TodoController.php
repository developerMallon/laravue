<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    public function show(\App\Todo $todo)
    {
        $todo->load('tasks');

        return new TodoResource($todo);
    }

    public function store(TodoStoreRequest $request)
    {
        $input = $request->validated();
        $todo = auth()->user()->todos()->create($input);

        return new TodoResource($todo);
    }

    public function update(\App\Todo $todo, TodoUpdateRequest $request)
    {
        $input = $request->validated();

        $todo->fill($input);

        $todo->save();

        return new TodoResource($todo->fresh());
    }

    public function destroy(\App\Todo $todo)
    {

        $todo->delete();
    }

    public function addTask(\App\Todo $todo, \App\Http\Requests\TodoTaskStoreRequest $request)
    {
        $input = $request->validated();

        $todoTask = $todo->tasks()->create($input);

        return new TodoTaskResource($todoTask);
    }
}
