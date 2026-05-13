@props(['tasks'])

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <!-- Tabel untuk Desktop -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            Task
                        </div>
                    </th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z">
                                </path>
                            </svg>
                            Category & Priority
                        </div>
                    </th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status
                        </div>
                    </th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tasks as $task)
                    <tr class="hover:bg-blue-50/30 transition-all duration-200 group">
                        <td class="px-6 py-4">
                           {{ $tasks->firstItem() + $loop->index }}
                        </td>
                        <!-- Kolom Tugas -->
                        <td class="px-6 py-4">
                            <div class="flex items-start gap-3">
                                <!-- Checkbox custom (opsional) -->

                                <div>
                                    <div
                                        class="font-semibold text-gray-800 {{ $task->status === 'completed' ? 'line-through text-gray-400' : '' }}">
                                        {{ $task->title }}
                                    </div>
                                    <div class="flex flex-col  gap-2 mt-1">
                                        <div class="text-xs text-gray-400 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Created At: {{ $task->created_at->format('d M Y, H:i') }}
                                        </div>
                                        @if ($task->due_date)
                                            <div class="text-xs text-red-400 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Due Date: {{ $task->due_date->format('d M Y, H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Kolom Kategori & Prioritas -->
                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                <!-- Kategori Badge -->
                                <div class="flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-gray-400"></div>
                                    <span class="text-xs text-gray-600">
                                        {{ $task->category->name ?? 'No Category' }}
                                    </span>
                                </div>
                                <!-- Prioritas Badge -->
                                <div>
                                    @php
                                        $priorityConfig = [
                                            'high' => ['color' => 'red', 'icon' => '🔴'],
                                            'medium' => ['color' => 'yellow', 'icon' => '🟡'],
                                            'low' => ['color' => 'green', 'icon' => '🟢'],
                                        ];
                                        $config = $priorityConfig[$task->priority] ?? $priorityConfig['medium'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $config['color'] }}-50 text-{{ $config['color'] }}-700 border border-{{ $config['color'] }}-200">
                                        <span>{{ $config['icon'] }}</span>
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Kolom Status -->
                        <td class="px-6 py-4">
                            <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="group relative inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 
                                    {{ $task->status === 'completed'
                                        ? 'bg-green-50 text-green-700 border border-green-200 hover:bg-green-100'
                                        : 'bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100' }}">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $task->status === 'completed' ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                                    {{ $task->status === 'completed' ? '✓ Selesai' : '○ Pending' }}
                                </button>
                            </form>
                        </td>

                        <!-- Kolom Aksi -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-all duration-200 group">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-2">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <div class="text-gray-500 font-medium">There are no tasks available.</div>
                                <a href="{{ route('tasks.create') }}"
                                    class="text-sm px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-semibold transition-colors mt-2">
                                    + Create a new task
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Card View untuk Mobile -->
    <div class="md:hidden divide-y divide-gray-100">
        @forelse($tasks as $task)
            <div class="p-4 hover:bg-gray-50 transition-all duration-200">
                <!-- Header Tugas -->
                <div class="flex items-start justify-between mb-2">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <div
                                class="w-2 h-2 rounded-full {{ $task->status === 'completed' ? 'bg-green-500' : 'bg-amber-500' }}">
                            </div>
                            <h3
                                class="font-semibold text-gray-800 {{ $task->status === 'completed' ? 'line-through text-gray-400' : '' }}">
                                {{ $task->title }}
                            </h3>
                        </div>
                        <div class="text-xs text-gray-400 space-x-2">
                            <span>{{ $task->created_at->format('d M Y') }}</span>
                            @if ($task->due_date)
                                <span>Deadline: {{ $task->due_date->format('d M Y, H:i') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- Tombol Aksi Mobile -->
                    <div class="flex gap-1">
                        <a href="{{ route('tasks.edit', $task) }}" class="p-2 text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Hapus tugas ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Detail Mobile -->
                <div class="grid grid-cols-2 gap-2 mt-3 text-xs">
                    <div>
                        <span class="text-gray-500">Kategori:</span>
                        <div class="mt-1">{{ $task->category->name ?? '-' }}</div>
                    </div>
                    <div>
                        <span class="text-gray-500">Prioritas:</span>
                        <div class="mt-1">
                            <span
                                class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold 
                            {{ $task->priority === 'high' ? 'bg-red-100 text-red-700' : ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Button Mobile -->
                <div class="mt-3">
                    <form action="{{ route('tasks.complete', $task) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="w-full py-2 rounded-lg text-sm font-semibold transition
                            {{ $task->status === 'completed' ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">
                            {{ $task->status === 'completed' ? '✓ Selesai' : '○ Tandai Selesai' }}
                        </button>
                    </form>
                </div>
            </div>
      @empty
            <div class="p-10 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div class="text-gray-500 font-medium mb-3">There are no tasks available.</div>
                <a href="{{ route('tasks.create') }}"
                    class="text-sm px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-semibold transition-colors">
                    + Create a new task
                </a>
            </div>
        @endforelse
    </div>
</div>
