@props(['action', 'method' => 'POST', 'task' => null, 'categories'])

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    {{-- Task Title --}}
    <div>
        <label for="title" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
            Task Title <span class="text-red-500">*</span>
        </label>
        <input type="text" name="title" id="title" value="{{ old('title', $task->title ?? '') }}"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 @error('title') border-red-500 ring-2 ring-red-200 @enderror"
            placeholder="What needs to be done?">
        @error('title')
            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
            Description <span class="text-gray-400 text-xs font-normal">(optional)</span>
        </label>
        <textarea name="description" id="description" rows="4"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 resize-y"
            placeholder="Add task details...">{{ old('description', $task->description ?? '') }}</textarea>
    </div>

    {{-- Category & Priority --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="category_id" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
                Category
            </label>

            <div class="space-y-3">
                <select name="category_id" id="category_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 bg-white cursor-pointer">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $task->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <div class="relative flex items-center py-1">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-xs font-medium text-gray-400 uppercase">or</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <input type="text" name="new_category_name" id="new_category_name"
                    value="{{ old('new_category_name') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 text-sm"
                    placeholder="+ Type new category name here...">
                @error('new_category_name')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="priority" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
                Priority <span class="text-red-500">*</span>
            </label>
            <select name="priority" id="priority"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 bg-white cursor-pointer">
                @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $val => $label)
                    <option value="{{ $val }}"
                        {{ old('priority', $task->priority ?? 'medium') == $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Status (hanya untuk edit) --}}
    @if ($task)
        <div>
            <label for="status" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
                Status
            </label>
            <select name="status" id="status"
                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200 bg-white cursor-pointer">
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}
                    class="text-yellow-600">⏳ Pending</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}
                    class="text-green-600">✅ Completed</option>
            </select>
        </div>
    @endif

    {{-- Deadline--}}
    <div>
        <label for="due_date" class="flex items-center gap-1 text-sm font-semibold text-gray-800 mb-2">
            Due Date <span class="text-gray-400 text-xs font-normal">(optional)</span>
        </label>
        <input type="datetime-local" name="due_date" id="due_date"
            value="{{ old('due_date', $task && $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
        <p class="text-xs text-gray-500 mt-1.5">Use the available date and time format</p>
    </div>

    {{-- Action button --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
        <a href="{{ route('tasks.index') }}"
            class="px-6 py-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-gray-200 font-medium transition-all duration-200 hover:shadow-sm">
            Cancel
        </a>
        <button type="submit"
            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 font-semibold shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
            {{ $task ? '✏️ Update Task' : '➕ Save Task' }}
        </button>
    </div>
</form>
