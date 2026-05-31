<?php

namespace App\View\Components;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskCard extends Component
{
    public Task $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }


    public function render(): View|Closure|string
    {
        return view('components.task-card');
    }
}
