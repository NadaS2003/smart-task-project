<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('status') && in_array($request->status, ['pending', 'in_progress', 'completed'])) {
            $query->where('status', $request->status);
        }

        // 2. فلترة مهام اليوم - تعمل بالتكامل مع بقية الشروط
        if ($request->query('today') == 1) {
            $query->whereDate('created_at', carbon::today());
        }

        // 3. فلترة الـ Focus Mode (الذكية والتكاملية)
        if ($request->has('focus')) {
            if ($request->focus === 'quick') {
                // غلفنا الشروط داخل دالة مجهولة لتعمل كقوسين (Condition Grouping)
                // هذا يضمن أن الـ OR لا تؤثر على فلاتر الـ status أو الـ today
                $query->where(function($q) {
                    $q->whereNull('description')
                        ->orWhereRaw('LENGTH(description) < 30');
                });
            } elseif ($request->focus === 'deep') {
                // هنا شرط الـ Deep Work مستقر ولا يحتاج لقوسين لأنه شرط واحد دائم (AND)
                $query->whereRaw('LENGTH(description) >= 30');
            }
        }
        $tasks = $query->latest()->get();
        return view('tasks.index', compact('tasks'));
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['user_id'] = 1; // Assuming user_id is 1 for demonstration purposes
        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function show(int $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }


    public function edit(int  $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }


    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    public function updateStatus(Request $request, int $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
