<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - University Schedule</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom admin styles -->
    @vite('resources/css/admin.css')

    <!-- Custom styles -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
             :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <h1 class="ml-3 text-xl font-bold text-white">Admin Panel</h1>
                </div>
                <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="mt-8 px-4 sidebar-scrollbar overflow-y-auto" style="height: calc(100vh - 88px);">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>

                    <!-- Exceptions -->
                    <a href="{{ route('admin.exceptions.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.exceptions.*') ? 'bg-indigo-600 text-white' : '' }}">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        Exceptions
                    </a>

                    <!-- Lessons -->
                    <a href="{{ route('admin.lessons.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.lessons.*') ? 'bg-indigo-600 text-white' : '' }}">
                        <i class="fas fa-book-open mr-3"></i>
                        Lessons
                    </a>

                    <!-- Teachers -->
                    <a href="{{ route('admin.teachers.index') }}"
                       class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-800 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.teachers.*') ? 'bg-indigo-600 text-white' : '' }}">
                        <i class="fas fa-chalkboard-teacher mr-3"></i>
                        Teachers
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 lg:static lg:overflow-y-visible">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="relative flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-600 lg:hidden">
                                <i class="fas fa-bars text-xl"></i>
                            </button>

                            <!-- Page Title -->
                            <h2 class="ml-4 lg:ml-0 text-2xl font-bold text-gray-900">
                                @yield('page-title', 'Dashboard')
                            </h2>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Profile dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                </button>

                                <div x-show="open" @click.outside="open = false" x-cloak
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-cloak
                         class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md mx-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-cloak
                         class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mx-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
         class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"></div>

    <!-- JavaScript -->
    <script>
        // CSRF token setup for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

        // Set up CSRF token for all AJAX requests
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
            }
        });

        // Bulk actions functionality
        function toggleAll(source) {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
            updateBulkActionsVisibility();
        }

        function updateBulkActionsVisibility() {
            const checkedBoxes = document.querySelectorAll('input[name="ids[]"]:checked');
            const bulkActions = document.getElementById('bulk-actions');
            if (bulkActions) {
                bulkActions.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
            }
        }

        function confirmBulkDelete() {
            const checkedBoxes = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checkedBoxes.length === 0) {
                alert('Please select at least one item to delete.');
                return false;
            }
            return confirm(`Are you sure you want to delete ${checkedBoxes.length} selected items?`);
        }

        // Initialize bulk actions on page load
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActionsVisibility);
            });
            updateBulkActionsVisibility();
        });
    </script>

    @stack('scripts')
</body>
</html>
