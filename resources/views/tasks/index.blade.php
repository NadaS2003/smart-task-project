<x-layouts.app>
    <section>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-md mb-xl border-b border-outline-variant pb-sm">
            <div class="flex items-center gap-sm overflow-x-auto whitespace-nowrap">
                <a href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'all'])) }}"
                   class="px-md py-sm rounded-lg font-label-md text-label-md transition-all {{ request('status', 'all') === 'all' ? 'bg-primary text-on-primary text-white shadow-sm' : 'text-secondary hover:bg-surface-container-high' }}">
                    All Tasks
                </a>
                <a href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'pending'])) }}"
                   class="px-md py-sm rounded-lg font-label-md text-label-md transition-all {{ request('status') === 'pending' ? 'bg-surface-variant text-on-surface-variant font-bold' : 'text-secondary hover:bg-surface-container-high' }}">
                    Pending
                </a>
                <a href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'in_progress'])) }}"
                   class="px-md py-sm rounded-lg font-label-md text-label-md transition-all {{ request('status') === 'in_progress' ? 'bg-primary-container text-on-primary-container font-bold' : 'text-secondary hover:bg-surface-container-high' }}">
                    In Progress
                </a>
                <a href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'completed'])) }}"
                   class="px-md py-sm rounded-lg font-label-md text-label-md transition-all {{ request('status') === 'completed' ? 'bg-tertiary-fixed text-on-tertiary-fixed font-bold' : 'text-secondary hover:bg-surface-container-high' }}">
                    Completed
                </a>
            </div>

            <div class="flex items-center gap-sm">
                <a href="{{ route('tasks.index', array_merge(request()->query(), ['today' => request('today') ? 0 : 1])) }}"
                   class="flex items-center gap-xs px-md py-xs rounded-full border text-xs font-medium transition-all {{ request('today') ? 'bg-primary/10 border-primary text-primary' : 'border-outline text-secondary hover:bg-surface-container-low' }}">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    {{ request('today') ? 'Showing Today Only' : 'Show Today Only' }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">

            @foreach($tasks as $task)
                @php
                    if ($task->status === 'completed') {
                        $statusText = 'Completed';
                        $statusClass = 'bg-tertiary-fixed text-on-tertiary-fixed';
                        $borderClass = 'border-l-4 border-tertiary';
                    } elseif ($task->status === 'in_progress') {
                        $statusText = 'In Progress';
                        $statusClass = 'bg-primary-container text-on-primary-container';
                        $borderClass = 'border-l-4 border-primary';
                    } else {
                        $statusText = 'Pending';
                        $statusClass = 'bg-surface-variant text-on-surface-variant';
                        $borderClass = 'border-l-4 border-outline-variant';
                    }
                @endphp

                <x-task-card
                    :id="$task->id"
                    :title="htmlspecialchars_decode($task->title, ENT_QUOTES)"
                    :desc="$task->description ? htmlspecialchars_decode($task->description, ENT_QUOTES) : null"
                    :priority="$statusText"
                    :priorityClass="$statusClass"
                    :borderClass="$borderClass"
                    :date="$task->created_at ? $task->created_at->format('M d, Y') : 'No Date'"
                />


            @endforeach
        </div>
    </section>

    <script>
        function toggleTask(taskId) {
            const taskElement = document.getElementById(taskId);
            const title = taskElement.querySelector('.task-title');
            const checkbox = taskElement.querySelector('input[type="checkbox"]');

            if (checkbox.checked) {
                taskElement.classList.add('completed-task');
                title.classList.remove('text-on-surface');
                title.classList.add('text-secondary');
            } else {
                taskElement.classList.remove('completed-task');
                title.classList.add('text-on-surface');
                title.classList.remove('text-secondary');
            }
        }
    </script>
</x-layouts.app>
