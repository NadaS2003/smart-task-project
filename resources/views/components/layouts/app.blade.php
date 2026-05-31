<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#3525cd",
                        "background": "#f8f9ff",
                        "on-surface": "#0b1c30",
                        "secondary": "#565e74",
                        "surface": "#f8f9ff",
                        "outline-variant": "#c7c4d8",
                        "secondary-container": "#dae2fd",
                        "on-secondary-container": "#5c647a",
                        "surface-container-low": "#eff4ff",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "tertiary": "#005338",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#6ffbbe",
                        "on-tertiary-fixed": "#002113",
                        "tertiary-fixed-dim": "#4edea3",
                        "surface-variant": "#d3e4fe",
                        "on-surface-variant": "#464555",
                        "surface-container-highest": "#d3e4fe"
                    },
                    "spacing": {
                        "base": "4px", "lg": "24px", "sm": "8px", "gutter": "20px",
                        "margin-mobile": "16px", "xs": "4px", "margin-desktop": "40px",
                        "xl": "32px", "md": "16px"
                    },
                    "fontFamily": { "body-lg": ["Inter"] }
                },
            },
        }
    </script>
    <style>
        .task-card { transition: all 0.2s ease; box-shadow: 0px 1px 3px rgba(15, 23, 42, 0.05); }
        .task-card:hover { box-shadow: 0px 4px 10px rgba(15, 23, 42, 0.1); transform: translateY(-1px); }
        .completed-task { opacity: 0.6; text-decoration: line-through; filter: grayscale(0.5); }
    </style>
</head>
<body class="bg-background text-on-surface font-body-lg overflow-hidden flex h-screen">

<aside class="fixed h-screen left-0 w-[280px] bg-surface border-r border-outline-variant flex flex-col p-lg gap-md z-40">
    <div class="mb-lg"><h1 class="font-display-lg text-3xl font-bold text-primary">TaskFlow</h1></div>
    <nav class="flex-1 flex flex-col gap-xs">
        <a href="{{ route('tasks.create') }}" class="bg-primary text-on-primary font-button text-white text-button py-md px-lg rounded-xl flex items-center justify-center gap-sm mb-lg active:scale-95 transition-transform">
            <span class="material-symbols-outlined" data-icon="add">add</span>
            Add Task
        </a>
        <a class="flex items-center gap-md rounded-lg px-md py-sm transition-all {{ request('focus') === 'quick' ? 'bg-secondary-container text-on-secondary-container border-l-4 border-primary font-semibold' : 'text-secondary hover:bg-gray-100' }}"
           href="{{ route('tasks.index', ['focus' => 'quick']) }}">
            Quick Wins
        </a>

        <a class="flex items-center gap-md text-secondary px-md py-sm hover:bg-gray-100 rounded-lg transition-all {{ request('focus') === 'deep' ? 'bg-secondary-container text-on-secondary-container border-l-4 border-primary font-semibold' : 'text-secondary hover:bg-gray-100' }}"
           href="{{ route('tasks.index', ['focus' => 'deep']) }}">
            Deep Work
        </a>
    </nav>
</aside>

<main class="flex-1 ml-[280px] overflow-y-auto bg-background min-h-screen">
    <header class="flex justify-between items-center w-full px-margin-desktop py-md sticky top-0 z-50 bg-background">
        <div class="flex-1 max-w-xl">
            <div class="relative flex items-center bg-surface-container-low rounded-xl px-md py-sm group focus-within:bg-surface-container-lowest focus-within:ring-2 focus-within:ring-primary transition-all">
                <span class="material-symbols-outlined text-secondary mr-sm" data-icon="search">search</span>
                <input class="bg-transparent border-none outline-none w-full text-body-lg font-body-lg placeholder:text-outline" placeholder="Search tasks, projects..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-lg ml-lg">
            <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center overflow-hidden">
                <img alt="User profile photo" class="w-full h-full object-cover" data-alt="Close-up portrait of a man with short brown hair and a friendly expression. He is wearing a minimalist dark sweater against a clean, softly lit architectural background with neutral tones. High-end lifestyle photography style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBElScbqWB0ZQkWOlMif0s1rUDKYDAquZ8JuooYMXqINqUqcqRPRgNB3xRqCEerZn362UosuT7EyN_NKS7hhxBqke6D4IrRzSFl8kRglCsXeM--OlbPFA0zlG6KKZbdLzIlUctjD4k6fzfuKP5Gog9N8u_5OcerzJqP6CwQV89AF5Im78sD-BnrCfuBPX8TQBI9TllsK9_-Utqhrq564K2HhnewwAKisDLd82b7_8RqDS4g3VHdCuD2VBZLTYmyLOdhXe9NA4SDuCw"/>
            </div>
        </div>
    </header>
    <div class="px-margin-desktop py-xl max-w-6xl mx-auto">
        {{ $slot }}
    </div>
</main>

</body>
<script>
    function confirmCardDelete(event, id) {
        event.preventDefault(); // منع الحذف الفوري التلقائي

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this task!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6B21A8', // نفس درجات اللون البنفسجي المودرن لتطبيقكِ
            cancelButtonColor: '#EF4444',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: '#FFFFFF',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl font-medium px-lg py-sm',
                cancelButton: 'rounded-xl font-medium px-lg py-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // يتم العثور على الفورم الدقيق من خلال الـ ID الفريد الذي مررناه للدالة
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
</html>
