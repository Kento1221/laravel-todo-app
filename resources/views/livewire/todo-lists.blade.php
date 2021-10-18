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
                   @click="$wire.emit('restoreTask', $wire.recentlyDeletedTaskId, activeTab.type)"
                   class="text-sm text-blue-500 cursor-pointer"></p>
            </div>
        </div>
        <div class="flex flex-1 items-start justify-end">
            <a href="#" @click="alert = false; description = ''; type = 'message'; msg = ''">X</a>
        </div>
    </div>
    <div class="flex flex-row p-3 shadow-sm xl:bg-white">
        <p class="flex-1 py-3 xl:px-3 text-lg md:text-2xl font-semibold xl:text-3xl"
           x-text="activeTab.title +' ('+ $wire.todoListCount+')'">
            {{__('Your task lists')}} <span class="text-gray-400">{{ ' ('.$todoListCount.')'}}</span>
        </p>
        <button wire:click="$toggle('newTaskModal')"
                class="text-xs my-auto md:text-lg xl:text-base p-3 xl:px-3 xl:py-0 bg-green-300 hover:bg-green-400 rounded-full xl:h-10 xl:content-center">
            <svg viewBox="0 0 20 20" class="w-6 h-6 inline-block">
                <path fill="#006400" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"/>
            </svg>
            {{__('Add new task list')}}
        </button>
    </div>
    {{--Task tabs--}}
    <div class="flex flex-row items-center p-3 shadow-sm bg-gray-50">
        <p class="text-base md:text-lg p-3">{{__('Selected task lists')}}:</p>
        <!-- Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button x-on:click="open = true"
                    class="flex flex-row items-center rounded-sm md:text-lg overflow-hidden focus:outline-none border border-gray-200 py-1 px-3">
                <p x-text="activeTab.text"></p>
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <!-- Dropdown Body -->
            <div x-show.transition="open" x-on:click.away="open = false"
                 class="absolute left-0 w-40 mt-2 py-2 z-50 bg-white border rounded shadow-xl">
                <div class="flex flex-col gap-y-1">

                    <template x-for="tab in tabs" :key="tab.id">
                        <a x-text="tab.text" @click="activeTab = tab; $wire.emit('tabChanged', tab.type); open = false;"
                           :class="{'text-blue-500': activeTab.type === tab.type}" class="md:text-lg transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-blue-500 hover:text-white"></a>
                    </template>
                </div>
            </div>
            <!-- // Dropdown Body -->
        </div>
        <!-- // Dropdown -->
    </div>
    {{--The task lists--}}
    <div
        class="flex flex-col lg:grid lg:grid-flow-row lg:grid-cols-3 lg:gap-5 p-3 lg:py-6"
         x-data="{todos: @entangle('todoList')}">
        <template x-for="list in todos" :key="list['id']">
            <div
                class="flex flex-col shadow-sm border-l-4 lg:flex-col lg:flex-1 lg:rounded-lg lg:shadow-xl lg:bg-white"
                :class="{'border-green-600': checkTaskStatus(list, 'Finished'),
                'border-blue-400': checkTaskStatus(list, 'Started'),
                'border-red-600': checkTaskStatus(list, 'Expired'),
                'border-yellow-400': checkTaskStatus(list, 'Prioritized')}">
                <div class="flex flex-col w-full lg:w-full gap-y-1 p-3 md:p-5  lg:h-48">
                    <p x-show="list['deleted_at'] == null" x-text="list['status'].status"
                       class="text-sm text-gray-400"></p>
                    <p x-show="list['steps'].length > 0 && list['status'].status != 'Finished' "
                       class="text-gray-400 text-sm hidden lg:block"
                       x-text="'{{__('Additional steps')}}: ' + list['steps'].length"></p>
                    <a class="text-lg md:text-xl lg:text-lg xl:text-xl font-semibold text-gray-700 truncate"
                        :class="{'line-through text-gray-300': list['deleted_at'] != null}"
                        x-text="list['title']" :href="'/task/'+list['id']"></a>
                    <p x-show="list['steps'].length > 0" class="text-gray-400 text-sm md:text-base lg:hidden"
                       x-text="'{{__('Additional steps')}}: ' + list['steps'].length">{</p>
                    <p class="flex-1 text-gray-400 text-sm md:text-base overflow-hidden" x-text="list['description']"
                       :class="{'line-through text-gray-300': list['deleted_at'] != null}"></p>
                </div>
                <div x-show="list['deleted_at'] == null" class="flex gap-1 p-1">
                    <button @click="$wire.showTask(list['id'])"
                            class="flex-1 px-3 md:w-full rounded bg-blue-200 hover:bg-blue-300">{{__('Edit')}}</button>
                    <button @click="$wire.destroyTask(list['id'], activeTab.type)"
                            class="flex-1 px-3 md:w-full rounded bg-red-400 hover:bg-red-500">{{__('Delete')}}</button>
                </div>
                <div x-show="list['deleted_at'] != null" class="flex gap-1 p-1">
                    <button @click="$wire.emit('restoreTask', list['id'], activeTab.type)"
                            class="flex-1 px-3 md:w-full rounded bg-green-100 hover:bg-green-200">{{__('Restore')}}</button>
                    <button @click="$wire.forceDestroyTask(list['id'], activeTab.type)"
                            class="flex-1 px-3 md:w-full rounded bg-red-200 hover:bg-red-300 text-sm">{{__('Delete permanently')}}</button>
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
                activeTab: {
                    'id': 1,
                    'title': '{{__('Your active task lists')}}',
                    'text': '{{__('Active')}}',
                    'type': 'active'
                },
                tabs: [
                    {
                        'id': 0,
                        'title': '{{__('Your all task lists')}}',
                        'text': '{{__('All')}}',
                        'type': 'All'
                    },
                    {
                        'id': 1,
                        'title': '{{__('Your active task lists')}}',
                        'text': '{{__('Active')}}',
                        'type': 'Active'
                    },
                    {
                        'id': 3,
                        'title': '{{__('Finished task lists')}}',
                        'text': '{{__('Finished')}}',
                        'type': 'Finished'
                    },
                    {
                        'id': 4,
                        'title': '{{__('Prioritized task lists')}}',
                        'text': '{{__('Prioritized')}}',
                        'type': 'Prioritized'
                    },
                    {
                        'id': 5,
                        'title': '{{__('Started task lists')}}',
                        'text': '{{__('Started')}}',
                        'type': 'Started'
                    },
                    {
                        'id': 6,
                        'title': '{{__('Expired task lists')}}',
                        'text': '{{__('Expired')}}',
                        'type': 'Expired'
                    },
                    {
                        'id': 2,
                        'title': '{{__('Your deleted task lists')}}',
                        'text': '{{__('Deleted')}}',
                        'type': 'Deleted'
                    }

                ]
            }
        }
    </script>
</div>
