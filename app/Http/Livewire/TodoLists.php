<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoLists extends Component
{
    public $title = 'Todo lists';
    public $todoListCount = 0;
    public $todoList = [];
    public $newTaskModal = false;
    public Task $newTask;

    public $rules = ['newTask.title' => 'required|string|max:50','newTask.description' => 'string|max:255',];

    public function mount()
    {
        $this->refreshTasks();

        $this->newTask = new Task;
    }

    public function render()
    {
        return view('livewire.todo-lists');
    }

    public function saveTask()
    {
        $this->toggleModal();
        //save task
        $this->newTask->user_id = Auth::id();
        $this->newTask->save();
        //refresh list
        $this->refreshTasks();

        return session()->flash('message','Task created successfully');
    }

    public function showTask($task)
    {
        return view('livewire.index');
    }

    public function destroyTask($task)
    {
        Task::find($task['id'])->delete();
        $this->refreshTasks();
        return session()->flash('message','Task deleted successfully');
    }

    public function toggleModal()
    {
        $this->newTaskModal = ! $this->newTaskModal;
    }

    private function refreshTasks()
    {
        $this->todoList = Auth::user()->tasks;
        $this->todoListCount = $this->todoList->count();
    }
}
