<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoLists extends Component
{
    public int $todoListCount = 0;
    public $todoList;

    //New task params
    public bool $newTaskModal = false;
    public Task $newTask;

    public int $recentlyDeletedTaskId;
    public string $activeTab = 'active';

    protected $listeners = [
        'tabChanged',
        'refreshTasks',
        'toggleModal',
        'restoreTask'
    ];

    public array $rules = [
        'newTask.title' => 'required|string|max:50',
        'newTask.description' => 'string|max:255'
    ];

    public function mount()
    {
        $this->activeTab = 'active';
        $this->refreshTasks();
        $this->newTask = new Task;
    }

    public function render()
    {
        return view('livewire.todo-lists');
    }

    public function toggleModal()
    {
        $this->newTaskModal = !$this->newTaskModal;
    }

    public function tabChanged($type = 'active')
    {
        if (!in_array($type, ['All', 'Deleted', 'Active', 'Finished', 'Prioritized', 'Expired', 'Started']))
            return;

        $this->activeTab = $type;
        $this->refreshTasks($this->activeTab);
    }

    public function refreshTasks($type = 'active')
    {
        switch ($type) {
            case 'Deleted':
                $this->todoList = Task::onlyTrashed()->with('steps', 'status')->where('user_id', Auth::id())->orderBy('deleted_at', 'desc')->get()->toArray();
                break;
            case 'All':
                $this->todoList = Task::withTrashed()->with('steps', 'status')->where('user_id', Auth::id())->get()->sortBy(['deleted_at', 'created_at'])->toArray();
                break;
            case 'Finished':
            case 'Prioritized':
            case 'Expired':
            case 'Started':
                $this->todoList = Task::with('steps', 'status')->where('user_id', Auth::id())->get()->where('status.status', $type)->sortBy(['deleted_at', 'created_at'])->toArray();
                break;
            default:
                $this->todoList = Auth::user()->tasks->load('steps', 'status')->toArray();
        }

        $this->todoListCount = count($this->todoList);
    }

    public function showTask($taskId)
    {
        return route('showTask', ['task' =>Task::find($taskId)->first()]);
    }

    public function saveTask()
    {
        $this->newTaskModal = false;
        $this->newTask->user_id = Auth::id();
        $this->newTask->save();
        $this->refreshTasks();
        $this->dispatchBrowserEvent('show-alert', ['message' => __('Task created successfully!')]);
    }

    public function destroyTask($taskId, $activeTab)
    {
        $temp_task = Task::find($taskId);
        if (!$temp_task) {
            $this->dispatchBrowserEvent('show-alert', ['message' => __('Something went wrong'), 'type' => 'error']);
            return;
        }

        $temp_task->delete();
        $this->refreshTasks($activeTab);
        $this->recentlyDeletedTaskId = $taskId;
        $this->dispatchBrowserEvent('show-alert', ['message' => __('Task deleted successfully!'), 'type' => 'delete', 'description' => 'To restore the deleted task click this passage.']);
    }

    public function restoreTask($taskId, $activeTab)
    {
        $task = Task::onlyTrashed()->find($taskId);
        if (is_null($task)) return;

        $task->restore();
        $this->refreshTasks($activeTab);
        $this->dispatchBrowserEvent('show-alert', ['message' => __('Task restored!')]);
    }

    public function forceDestroyTask($taskId, $activeTab)
    {
        $task = Task::onlyTrashed()->find($taskId);
        if (is_null($task)) return;

        $task->forceDelete();
        $this->refreshTasks($activeTab);
        $this->dispatchBrowserEvent('show-alert', ['message' => __('Task deleted permanently!')]);
    }

}
