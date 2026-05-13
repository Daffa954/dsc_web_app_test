@props(['categories'])


<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
        {{-- Search bar --}}
        <div class="w-full md:flex-[2] min-w-[250px]">
            <label for="search" class="block text-xs font-semibold text-gray-600 mb-1.5">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="Search tasks...">
            </div>
        </div>
        {{-- Status & Category Filter--}}
        <div class="flex-1 min-w-[160px]">
            <label for="status" class="block text-xs font-semibold text-gray-600 mb-1.5">Status</label>
            <select name="status" id="status"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="flex-1 min-w-[160px]">
            <label for="category_id" class="block text-xs font-semibold text-gray-600 mb-1.5">Category</label>
            <select name="category_id" id="category_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[190px]">
            <label for="sort" class="block text-xs font-semibold text-gray-600 mb-1.5">Sort By</label>
            <select name="sort" id="sort"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer">
                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Newest</option>
                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                <option value="due_date_asc" {{ request('sort') === 'due_date_asc' ? 'selected' : '' }}>Due Date (Ascending)
                </option>
                <option value="due_date_desc" {{ request('sort') === 'due_date_desc' ? 'selected' : '' }}>Due Date (Descending)
                <option value="priority_high" {{ request('sort') === 'priority_high' ? 'selected' : '' }}>High Priority First</option>
                   </option>
            </select>
        </div>

        <div class="flex gap-2 w-full sm:w-auto mt-2 sm:mt-0">
            <button type="submit"
                class="flex-1 sm:flex-none px-5 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-gray-900 transition shadow-sm">
                Apply
            </button>

           
            @if (request()->hasAny(['status', 'category_id', 'sort']) && request('sort') !== 'latest')
                <a href="{{ route('tasks.index') }}"
                    class="flex-1 sm:flex-none px-5 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition border border-gray-300 shadow-sm text-center">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>
