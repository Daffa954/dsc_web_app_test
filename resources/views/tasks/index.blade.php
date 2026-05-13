@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6 mt-12">
        <h1 class="text-2xl font-bold">List Tasks</h1>
        <a href="{{ route('tasks.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Add Task
        </a>
    </div>

    <x-filter_and_sort :categories="$categories" />

    <x-task_table :tasks="$tasks" />
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
@endsection
