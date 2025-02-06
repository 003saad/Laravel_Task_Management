<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Add New Task</h3>
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="flex">
                                <input type="text" name="title" placeholder="Task title" required
                                    class="flex-1 rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                                    Add Task
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Filter Tasks</h3>
                        <div class="flex space-x-4">
                            <a href="{{ route('tasks.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded {{ $status === null ? 'bg-gray-300' : '' }}">
                                All
                            </a>
                            <a href="{{ route('tasks.index', ['status' => 'pending']) }}"
                                class="bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-bold py-2 px-4 rounded {{ $status === 'pending' ? 'bg-yellow-300' : '' }}">
                                Pending
                            </a>
                            <a href="{{ route('tasks.index', ['status' => 'completed']) }}"
                                class="bg-green-200 hover:bg-green-300 text-green-800 font-bold py-2 px-4 rounded {{ $status === 'completed' ? 'bg-green-300' : '' }}">
                                Completed
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Task List</h3>
                        @forelse ($tasks as $task)
                            <div class="bg-gray-100 p-4 rounded-md mb-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="mr-2">
                                            @if ($task->completed)
                                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @else
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            @endif
                                        </button>
                                    </form>
                                    <span class="{{ $task->completed ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</span>
                                </div>
                                <div class="flex space-x-2">
                                  <!-- <button class="text-blue-500 hover:text-blue-700" onclick='editTask(@json($task))'>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
</button> -->
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No tasks found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editTaskModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Task</h3>
                <form id="editTaskForm" class="mt-2" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" id="editTaskTitle" required
                        class="w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <div class="items-center px-4 py-3">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editTask(taskId, taskTitle) {
            const modal = document.getElementById('editTaskModal');
            const form = document.getElementById('editTaskForm');
            const titleInput = document.getElementById('editTaskTitle');

            form.action = `/tasks/${taskId}`;
            titleInput.value = taskTitle;
            modal.classList.remove('hidden');
        }

        document.addEventListener('click', function(event) {
            const modal = document.getElementById('editTaskModal');
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>