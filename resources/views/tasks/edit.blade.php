<x-layouts.app>
    <div class="max-w-[600px] mx-auto my-md px-margin-mobile">

        <div class="flex items-center justify-between mb-sm">
            <div>
                <h1 class="font-display-lg text-display-lg font-bold text-on-surface">Edit Task</h1>
                <p class="font-body-sm text-body-sm text-secondary mt-xs">Update your task details and status</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="w-9 h-9 flex items-center justify-center text-secondary hover:bg-surface-container-high rounded-full transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant shadow-sm">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-md">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-xs">
                    <label for="title" class="font-label-md text-label-md text-on-surface font-medium">Task Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', htmlspecialchars_decode($task->title, ENT_QUOTES)) }}"
                        class="w-full px-md py-sm bg-surface border border-outline rounded-lg font-body-lg text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                        required
                    >
                </div>

                <div class="flex flex-col gap-xs">
                    <label for="description" class="font-label-md text-label-md text-on-surface font-medium">Description (Optional)</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        class="w-full px-md py-sm bg-surface border border-outline rounded-lg font-body-lg text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none"
                        placeholder="Add some details about this task..."
                    >{{ old('description', htmlspecialchars_decode($task->description, ENT_QUOTES)) }}</textarea>
                </div>

                <div class="flex flex-col gap-xs">
                    <label for="status" class="font-label-md text-label-md text-on-surface font-medium">Task Status</label>
                    <div class="relative">
                        <select
                            name="status"
                            id="status"
                            class="w-full px-md py-sm bg-surface border border-outline rounded-lg font-body-lg text-on-surface appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all cursor-pointer"
                        >
                            <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-md top-1/2 -translate-y-1/2 pointer-events-none text-secondary text-xl">
                        expand_more
                    </span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-sm pt-sm border-t border-outline-variant/40">
                    <a href="{{ route('tasks.index') }}" class="px-lg py-sm bg-surface-container-high text-secondary rounded-lg font-button text-button hover:bg-outline-variant/40 transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="px-lg py-sm bg-primary text-on-primary text-white rounded-lg font-button text-button shadow-sm hover:bg-primary-container active:scale-[0.98] transition-all">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>

    </div></x-layouts.app>
