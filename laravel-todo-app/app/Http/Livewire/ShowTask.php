<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class ShowTask extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.show-task');
    }
}
