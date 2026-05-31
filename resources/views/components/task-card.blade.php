@props([
    'id',
    'title',
    'desc' => null,
    'priority' => 'Pending',
    'priorityClass' => 'bg-surface-variant text-on-surface-variant',
    'borderClass' => 'border-l-4 border-outline-variant',
    'date' => 'Today'
])

<div {{ $attributes->merge(['class' => "task-card bg-surface-container-lowest p-md rounded-xl flex flex-col justify-between min-h-[160px] relative transition-all duration-300 hover:shadow-md " . $borderClass]) }} id="task-{{ $id }}">

    <form action="{{ route('tasks.updateStatus', $id) }}" method="POST" id="form-checkbox-{{ $id }}" class="hidden">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="{{ $priority === 'Completed' ? 'pending' : 'completed' }}">
    </form>

    <div>
        <div class="flex justify-between items-start mb-sm">
            <label class="flex items-start gap-md cursor-pointer group flex-1">
                <div class="relative mt-1">
                    <input
                        class="peer sr-only"
                        type="checkbox"
                        {{ $priority === 'Completed' ? 'checked' : '' }}
                        onchange="document.getElementById('form-checkbox-{{ $id }}').submit()"
                    />
                    <div class="w-5 h-5 border-2 border-outline rounded flex items-center justify-center peer-checked:bg-tertiary peer-checked:border-tertiary transition-all">
                        <span class="material-symbols-outlined text-on-tertiary text-sm hidden peer-checked:block" data-icon="check">check</span>
                    </div>
                </div>
                <div class="pr-lg"> <h3 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors task-title {{ $priority === 'Completed' ? 'text-secondary line-through opacity-60' : '' }}">
                        {{ htmlspecialchars_decode($title, ENT_QUOTES) }}
                    </h3>
                    @if($desc)
                        <p class="font-body-sm text-body-sm text-secondary mt-xs task-desc {{ $priority === 'Completed' ? 'opacity-50' : '' }}">{{ htmlspecialchars_decode($desc, ENT_QUOTES) }}</p>
                    @endif
                </div>
            </label>

            <div class="flex items-center gap-xs">

                <a href="{{ route('tasks.show', $id) }}"
                   class="w-7 h-7 flex items-center justify-center text-secondary hover:text-primary rounded-full hover:bg-primary/5 transition-all"
                   title="View Task">
                    <span class="material-symbols-outlined !text-[18px] leading-none">visibility</span>
                </a>

                <a href="{{ route('tasks.edit', $id) }}"
                   class="w-7 h-7 flex items-center justify-center text-secondary hover:text-amber-600 rounded-full hover:bg-amber-500/5 transition-all"
                   title="Edit Task">
                    <span class="material-symbols-outlined !text-[18px] leading-none">edit</span>
                </a>

                <form action="{{ route('tasks.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}" class="inline-flex">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            onclick="confirmCardDelete(event, '{{ $id }}')"
                            class="w-7 h-7 flex items-center justify-center text-secondary hover:text-error rounded-full hover:bg-error/5 transition-all p-0 border-none cursor-pointer"
                            title="Delete Task">
                        <span class="material-symbols-outlined !text-[18px] leading-none">delete</span>
                    </button>
                </form>
            </div>        </div>
    </div>

    <div class="flex items-center justify-between mt-md">
        <div class="flex items-center gap-sm">
            <span class="{{ $priorityClass }} px-sm py-xs rounded font-label-md text-label-md">{{ $priority }}</span>

            @if($priority === 'Pending')
                <form action="{{ route('tasks.updateStatus', $id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="in_progress">
                    <button type="submit" class="text-xs bg-primary/10 text-primary hover:bg-primary hover:text-white px-sm py-xs rounded flex items-center gap-xs transition-all active:scale-95">
                        <span class="material-symbols-outlined text-xs" style="font-size: 14px;">play_arrow</span>
                        Start
                    </button>
                </form>
            @endif
        </div>

        <div class="flex items-center gap-xs text-secondary">
            <span class="material-symbols-outlined text-base" data-icon="event">event</span>
            <span class="font-label-md text-label-md">{{ $date }}</span>
        </div>
    </div>
</div>
