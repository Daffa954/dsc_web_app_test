{{-- Success Notification --}}
@if (session('success'))
    <div
        class="fixed top-5 right-5 z-50 auto-close-alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 transition-all duration-500 ease-out flex justify-between items-center shadow-lg min-w-[250px]">
        <div class="flex items-center gap-2">
            <span>✅</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif

{{-- Error Notification --}}
@if (session('error'))
    <div
        class="fixed top-5 right-5 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 flex justify-between items-center shadow-lg min-w-[250px]">
        <div class="flex items-center gap-2">
            <span>⚠️</span>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.style.display='none'"
            class="text-red-700 hover:text-red-900 text-xl font-bold pl-4 leading-none transition outline-none">
            &times;
        </button>
    </div>
@endif


@push('scripts')
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.auto-close-alert');

            alerts.forEach(function(alert) {

                alert.style.opacity = '0';
                alert.style.transform = 'translateX(20px)';

                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 5000);
    </script>
@endpush
