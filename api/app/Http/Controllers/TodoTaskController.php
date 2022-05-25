<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoTaskUpdateRequest;
use App\Http\Resources\TodoTaskResource;
use Illuminate\Http\Request;

class TodoTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function update(\App\TodoTask $todoTask, TodoTaskUpdateRequest $request)
    {
        $input = $request->validated();

        $todoTask->fill($input);

        $todoTask->save();

        return new TodoTaskResource($todoTask);
    }

    public function destroy(\App\TodoTask $todoTask)
    {
        $todoTask->delete();
    }
}
