<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoLists extends Component
{
    public $title = 'Todo lists';
    public $todoListCount = 0;
    public $todoList = [];

    public function mount()
    {
        $this->todoList = Auth::user()->tasks;
        $this->todoListCount = $this->todoList->count();
    }

    public function render()
    {
        return view('livewire.todo-lists');
    }

    public function newTask()
    {
        return redirect()->to('/new-task');

    }
}
