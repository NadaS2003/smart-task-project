<x-layouts.app>
    <div class="fixed inset-0 z-[100] flex items-center justify-center px-margin-mobile scrim-overlay bg-black/20 backdrop-blur-sm">
        <div class="bg-surface-container-lowest w-full max-w-[600px] rounded-xl shadow-xl overflow-hidden border border-outline-variant animate-in fade-in zoom-in duration-300">

            <div class="px-xl py-lg border-b border-outline-variant flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-headline-md text-on-surface">Add New Task</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Stay organized and get things done.</p>
                </div>
                <button type="button" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high text-secondary transition-colors" onclick="window.history.back()">
                    <span class="material-symbols-outlined" data-icon="close">close</span>
                </button>
            </div>

            <form action="{{ route('tasks.store') }}" method="POST" class="p-xl space-y-lg">
                @csrf <x-input
                    name="title"
                    label="Task Title"
                    placeholder="What needs to be done?"
                    required
                    autofocus
                />

                <div class="space-y-base">
                    <label for="description" class="font-label-md text-label-md text-secondary uppercase block">Description (Optional)</label>
                    <textarea name="description" id="description" class="w-full bg-[#F1F5F9] border-none rounded-lg px-md py-md font-body-lg text-body-lg text-on-surface placeholder:text-outline transition-all resize-none focus:outline-none focus:border-primary focus:bg-white" placeholder="Add some details..." rows="3">{{ old('description') }}</textarea>
                </div>



                <div class="flex items-center justify-end gap-md pt-xl">
                    <button class="px-lg py-md rounded-lg font-button text-button text-secondary hover:bg-surface-container-high transition-all" onclick="window.history.back()" type="button">
                        Cancel
                    </button>
                    <button class="px-xl py-md rounded-lg font-button text-white text-button bg-primary text-on-primary shadow-lg hover:shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-sm" type="submit">
                        <span class="material-symbols-outlined text-[20px]" data-icon="check">check</span>
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed top-1/4 left-1/4 w-64 h-64 bg-primary/5 blur-[120px] rounded-full -z-10"></div>
    <div class="fixed bottom-1/4 right-1/4 w-96 h-96 bg-tertiary/5 blur-[150px] rounded-full -z-10"></div>

    <script>
        document.querySelectorAll('input, textarea, select').forEach(el => {
            el.addEventListener('focus', () => {
                const label = el.parentElement.querySelector('label');
                if(label) label.style.color = '#3525cd';
            });
            el.addEventListener('blur', () => {
                const label = el.parentElement.querySelector('label');
                if(label) label.style.color = '';
            });
        });
    </script>
</x-layouts.app>
