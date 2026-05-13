@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-8">Add New Task</h1>

    <x-task_form 
        :action="route('tasks.store')" 
        :categories="$categories" 
    />
</div>
@endsection