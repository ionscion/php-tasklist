<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//php artisan route:list - to see all routes


Route::view('/tasks/create', 'create')->name('tasks.create');
// when using query builder we can use get() or first() methods
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10),
    ]);
})->name('tasks.index');

// Route::get('/about', function () {
//     return "About page";
// })->name("about");

// Route::get('/greet/{name}', function ($name) {
//     return "Hello, $name !";
// });

// Route::get("aboot", function () {
//     return redirect()->route("about");
// });

Route::get('/tasks/{task}/edit', function (Task $task) {

    return view('edit', [
        'task' =>  $task,
    ]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function (Task $task) {

    return view('show', [
        'task' => $task,
    ]);
})->name('tasks.show');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully.');
})->name('tasks.update');

Route::post('/tasks', function (TaskRequest $request) {
    $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully.');
})->name('tasks.store');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully.');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleCompleted();

    return redirect()->back()
        ->with('success', 'Task updated successfully.');
})->name('tasks.complete');

Route::fallback(function () {
    return "still got something";
});

Route::get("/", function () {
    return redirect()->route("tasks.index");
});
