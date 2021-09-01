<div class="xl:bg-gray-100" x-data="tabs()">
    <div class="flex flex-row bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3"
         x-data="{alert: false, msg: '', description: '', type: 'message'}" x-show="alert"
         x-on:show-alert.window="alert=true; msg = $event.detail.message; description = $event.detail.description"
         x-transition>
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="flex-1 font-bold" x-text="msg"/>
                <p x-if="type === 'delete'" x-text="description"
                   @click="$wire.emit('restoreTask', $wire.recentlyDeletedTaskId, activeTab)"
                   class="text-sm text-blue-500 cursor-pointer"></p>
            </div>
        </div>
        <div class="flex flex-1 items-start justify-end">
            <a href="#" @click="alert = false; description = ''; type = 'message'; msg = ''">X</a>
        </div>
    </div>
    <div class="flex flex-row p-3 shadow-sm xl:bg-white">
        <p class="flex-1 py-3 xl:px-3 text-lg md:text-2xl font-semibold xl:text-3xl"
           x-text="tabs[activeTab].title +' ('+ $wire.todoListCount+')'">
            {{__('Your task lists')}} <span class="text-gray-400">{{ ' ('.$todoListCount.')'}}</span>
        </p>
        <button wire:click="$toggle('newTaskModal')"
                class="text-xs my-auto md:text-lg xl:text-base p-3 xl:px-3 xl:py-0 bg-green-300 hover:bg-green-400 rounded-full xl:h-10 xl:content-center">
            <svg viewBox="0 0 20 20" class="w-6 h-6 inline-block">
                <path fill="#006400" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
            </svg>
            {{__('Add new task')}}
        </button>
    </div>

    {{--Task tabs--}}
    <div class="flex flex-row gap-3 p-3 shadow-sm">
        <template x-for="tab in tabs" :key="tab.id">
            <button x-text="tab.text" @click="activeTab = tab.type; $wire.emit('tabChanged', tab.type)"
                    :class="{'text-blue-500': activeTab === tab.type}" class="px-3"></button>
        </template>
    </div>

    {{--The tasks--}}
    <div class="flex flex-col xl:grid xl:grid-flow-row xl:grid-cols-3 xl:gap-5 p-3 xl:py-6"
         x-data="{todos: @entangle('todoList')}">
        <template x-for="list in todos" :key="list['id']">
            <div
                class="flex md:flex-col lg:flex-row xl:flex-col xl:flex-1 shadow-sm xl:rounded-lg xl:shadow-xl border-l-4 xl:bg-white"
                :class="{'border-green-600': checkTaskStatus(list, 'Finished'),
                'border-blue-400': checkTaskStatus(list, 'Started'),
                'border-red-600': checkTaskStatus(list, 'Expired'),
                'border-yellow-400': checkTaskStatus(list, 'Prioritized')}">
                <div class="flex flex-col w-3/4 md:w-full lg:w-4/5 xl:w-full gap-y-1 p-3 md:p-5  xl:h-48">
                    <p x-show="list['deleted_at'] == null" x-text="list['status'].status" class="text-sm text-gray-400"></p>

                    <p x-show="list['steps'].length > 0 && list['status'].status != 'Finished' " class="text-gray-400 text-sm hidden xl:block"
                       x-text="'{{__('Additional steps')}}: ' + list['steps'].length"></p>
                    <h1 class="text-lg md:text-xl lg:text-lg xl:text-xl font-semibold text-gray-700 truncate"
                        :class="{'line-through text-gray-300': list['deleted_at'] != null}"
                        x-text="list['title']"></h1>
                    <p x-show="list['steps'].length > 0" class="text-gray-400 text-sm md:text-base xl:hidden"
                       x-text="'{{__('Additional steps')}}: ' + list['steps'].length">{</p>
                    <p class="text-gray-400 text-sm md:text-base overflow-hidden" x-text="list['description']"
                       :class="{'line-through text-gray-300': list['deleted_at'] != null}"></p>
                </div>
                <div x-show="list['deleted_at'] == null"
                     class="flex flex-col md:flex-row lg:h-12 lg:my-auto py-3 xl:mx-auto xl:w-full gap-y-3 md:gap-3 justify-center w-1/4 md:w-full lg:w-1/5 pr-2 md:px-3 md:pb-3">
                    <button @click="$wire.showTask(list['id'])"
                            class="px-3 md:w-full rounded-full bg-blue-200 hover:bg-blue-300">{{__('Display')}}</button>
                    <button @click="$wire.destroyTask(list['id'], activeTab)"
                            class="px-3 md:w-full rounded-full bg-red-400 hover:bg-red-500">{{__('Delete')}}</button>
                </div>
                <div x-show="list['deleted_at'] != null"
                     class="flex flex-col md:flex-row lg:h-12 lg:my-auto py-3 xl:mx-auto xl:w-full gap-y-3 md:gap-3 justify-center w-1/4 md:w-full lg:w-1/5 pr-2 md:px-3 md:pb-3">
                    <button @click="$wire.emit('restoreTask', list['id'], activeTab)"
                            class="px-3 md:w-full rounded-full bg-green-200 hover:bg-green-300">{{__('Restore')}}</button>
                    <button @click="$wire.forceDestroyTask(list['id'], activeTab)"
                            class="px-3 md:w-full rounded-full bg-red-400 hover:bg-red-500 text-sm">{{__('Delete permanently')}}</button>
                </div>
            </div>
        </template>
        <div
            class="text-center text-gray-400 p-3 xl:hidden">{{$todoListCount > 0 ? ($todoListCount > 1 ? $todoListCount . ' '. __('task lists'): $todoListCount.' '. __('task list')): 'No task lists'}}</div>
    </div>

    {{--The create new task modal--}}
    <x-jet-dialog-modal wire:model="newTaskModal">
        <x-slot name="title">{{__('Create new task')}}</x-slot>
        <x-slot name="content">
            <form action="">
                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}"/>
                    <x-jet-input wire:model="newTask.title" id="title" class="block mt-1 w-full" type="text"
                                 name="title" required/>
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}"/>
                    <x-jet-input wire:model="newTask.description" id="description" class="block mt-1 w-full"
                                 type="textarea" name="description"/>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('newTaskModal')" wire:loading.attr="disabled">
                {{__('Cancel')}}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="saveTask" wire:loading.attr="disabled">
                {{__('Save')}}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <script>
        function checkTaskStatus(object, expected) {
            return object['status'].status == expected && object['deleted_at'] == null;
        }

        function tabs() {
            return {
                activeTab: 'active',
                tabs: [
                    {
                        'id': 0,
                        'title': '{{__('Your active tasks')}}',
                        'text': '{{__('Active tasks')}}',
                        'type': 'active'
                    },
                    {
                        'id': 1,
                        'title': '{{__('Your all tasks')}}',
                        'text': '{{__('All tasks')}}',
                        'type': 'all'
                    },
                    {
                        'id': 2,
                        'title': '{{__('Your deleted tasks')}}',
                        'text': '{{__('Deleted tasks')}}',
                        'type': 'deleted'
                    }

                ]
            }
        }
    </script>
</div>
