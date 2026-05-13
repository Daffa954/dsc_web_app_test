<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        
        $filters = $request->only(['status', 'category_id', 'search']);
        $sort = $request->input('sort', 'latest');

     
       $tasks = Task::getFilteredTasks($filters, $sort)->withQueryString();

        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255', 
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

      
        if (!empty($validated['new_category_name'])) {
            // firstOrCreate mencegah pembuatan kategori ganda jika user mengetik nama yang sudah ada
            $category = Category::firstOrCreate([
                'name' => trim($validated['new_category_name'])
            ]);

            // Timpa category_id dengan ID dari kategori yang baru dibuat
            $validated['category_id'] = $category->id;
        }

        // Hapus new_category_name dari array sebelum dimasukkan ke database tugas
        unset($validated['new_category_name']);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task Has Been Created!');
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task Has Been Updated!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task Has Been Deleted!');
    }

    public function toggleComplete(Task $task)
    {
        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed'
        ]);

        return back()->with('success', 'Task Status Updated!');
    }
}