<div class="xl:bg-gray-100">
    <div class="flex flex-row p-3 shadow-sm xl:bg-white">
        <p class="flex-1 py-3 xl:px-3 text-lg md:text-2xl font-semibold xl:text-3xl">
            {{__('Your task lists')}} <span class="text-gray-400">{{ ' ('.$todoListCount.')'}}</span>
        </p>
        <button wire:click="newTask" class="text-xs my-auto md:text-lg xl:text-base p-3 xl:px-3 xl:py-0 bg-green-300 hover:bg-green-400 rounded-full xl:h-10 xl:content-center">
                <svg viewBox="0 0 20 20" class="w-6 h-6 inline-block">
                    <path fill="#006400" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
                </svg>
                {{__('Add new task')}}
        </button>

    </div>
    <div class="flex flex-col xl:grid xl:grid-flow-col xl:grid-cols-3 xl:gap-5 xl:p-3">
        @foreach($todoList as $task)
            <div class="flex md:flex-col lg:flex-row xl:flex-col xl:flex-1 shadow-sm xl:rounded-lg xl:shadow-xl xl:bg-white">
                <div class="flex flex-col w-3/4 md:w-full lg:w-4/5 xl:w-full gap-y-1 p-3 md:p-5  xl:h-48">
                    @if($task->steps->count() != 0)
                        <p class="text-gray-400 text-base hidden xl:block">{{__('Additional steps').': '.$task->steps->count()}}</p>
                    @endif
                    <h1 class="text-lg md:text-xl lg:text-lg xl:text-xl font-semibold text-gray-700 truncate">{{$task->title}}</h1>
                    @if($task->steps->count() != 0)
                        <p class="text-gray-400 text-sm md:text-base xl:hidden">{{__('Additional steps').': '.$task->steps->count()}}</p>
                    @endif
                    <p class="text-gray-400 text-sm md:text-base overflow-hidden">{{$task->description}}</p>

                </div>
                <div class="flex flex-col md:flex-row lg:h-12 lg:my-auto xl:mx-auto xl:w-full gap-y-3 md:gap-3 justify-center w-1/4 md:w-full lg:w-1/5 pr-2 md:px-3 md:pb-3">
                    <button class="px-3 py-1 md:w-full rounded-full bg-blue-200 hover:bg-blue-300">{{__('Display')}}</button>
                    <button class="px-3 py-1 md:w-full rounded-full bg-red-400 hover:bg-red-500">{{__('Delete')}}</button>
                </div>
            </div>
        @endforeach
        <div
            class="text-center text-gray-400 p-3 xl:hidden">{{$todoListCount > 0 ? ($todoListCount > 1 ? $todoListCount . ' '. __('task lists'): $todoListCount.' '. __('task list')): 'No task lists'}}</div>
    </div>
</div>
