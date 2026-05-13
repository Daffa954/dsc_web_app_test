<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
           
            <a href="{{ route('tasks.index') }}" class="flex items-center space-x-2 group">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <span
                    class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent group-hover:from-blue-700 group-hover:to-blue-900 transition-all duration-200">
                    TaskApp
                </span>
            </a>

            <div class="flex items-center space-x-1 sm:space-x-3">
                
                <a href="{{ route('tasks.index') }}"
                    class="relative px-3 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 font-medium text-sm sm:text-base group">
                    <span>Dashboard</span>
                    @if (request()->routeIs('tasks.index'))
                        <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>

               
            </div>
        </div>
    </div>

    @if (request()->routeIs('tasks.create', 'tasks.edit'))
        <div class="h-1 bg-gray-100">
            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 rounded-full" style="width: 50%"></div>
        </div>
    @endif
</nav>
