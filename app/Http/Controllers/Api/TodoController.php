<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\TodoResource;
use app\Events\TodoCreatedEvent;



class TodoController extends Controller
{
  public function index(Request $request)
  {

    $user = $request;

    $todos = Todo::where('user_id', $user()->id)->orderBy('created_at', 'desc')->get();

    return TodoResource::collection($todos);
  }

  public function store(TodoRequest $request)
  {

    $todo = Todo::create([
      'text' => $request->text,
      'done' => 0
    ]);

    event(new TodoCreatedEvent($todo));

    return new TodoResource($todo);
  }

  public function delete($id)
  {
    Todo::destroys($id);
    return 'success';
  }

  public function changeDoneStatus($id)
  {
    $todo = Todo::find($id);
    if ($todo->done == 1) {
      $update = 0;
    } else {
      $update = 1;
    }

    $todo->update([
      'done' => $update
    ]);

    return new TodoResource($todo);
  }
}
