<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>University Schedule - Smart Timetable Management</title>
        <meta name="description" content="Manage your university schedule effortlessly with our smart timetable application. Get class timings, schedule updates, and more.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.js">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            ETI Schedule
                        </span>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a>
                        <a href="#demo" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demo</a>
                        <a href="#schedule" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Schedule</a>
                    </div>

                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
                <div class="px-4 py-4 space-y-2">
                    <a href="#features" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a>
                    <a href="#demo" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demo</a>
                    <a href="#schedule" class="block px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Schedule</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-medium mb-8">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Smart University Scheduling
                    </div>

                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Your <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Smart</span> University
                        <br>Schedule Assistant
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                        Never miss a class again. Get instant access to your timetable, class timings, and schedule updates through our intelligent Telegram bot.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#demo" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a1.5 1.5 0 011.5 1.5v1a1.5 1.5 0 01-1.5 1.5H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Try Demo
                        </a>
                        <a href="#features" class="inline-flex items-center px-8 py-4 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:border-blue-500 dark:hover:border-blue-400 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-300">
                            Learn More
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Powerful Features</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Everything you need to manage your university schedule efficiently
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Class Timings</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Get instant access to class bell schedules and timing information with simple commands.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Smart Schedule</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            View your complete timetable with customizable formats including times and teacher information.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Telegram Integration</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Access all features through our intelligent Telegram bot with simple, intuitive commands.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Instant Updates</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Get real-time notifications about schedule changes and important announcements.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Smart Analytics</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Track your attendance patterns and get insights into your academic schedule.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Mobile Friendly</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Access your schedule anywhere, anytime with our responsive design and mobile optimization.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Demo Section -->
        <section id="demo" class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">See It In Action</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Try our interactive demo to see how easy it is to manage your schedule
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-6 shadow-2xl">
                            <div class="flex items-center space-x-2 mb-4">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-gray-400 text-sm ml-4">Telegram Bot Demo</span>
                            </div>

                            <div class="space-y-4 font-mono text-sm">
                                <div class="flex items-start space-x-2">
                                    <span class="text-blue-400">You:</span>
                                    <span class="text-white">/rings</span>
                                </div>

                                <div class="flex items-start space-x-2">
                                    <span class="text-green-400">Bot:</span>
                                    <div class="text-gray-300">
                                        <div>1️⃣ 8:20 - 9:40</div>
                                        <div>2️⃣ 9:50 - 11:10</div>
                                        <div>3️⃣ 11:40 - 13:00</div>
                                        <div>4️⃣ 13:10 - 14:30</div>
                                        <div>5️⃣ 14:40 - 16:00</div>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-2">
                                    <span class="text-blue-400">You:</span>
                                    <span class="text-white">/schedule today</span>
                                </div>

                                <div class="flex items-start space-x-2">
                                    <span class="text-green-400">Bot:</span>
                                    <div class="text-gray-300">
                                        <div>📅 <strong>Today's Schedule</strong></div>
                                        <div>1️⃣ Mathematics</div>
                                        <div>2️⃣ Physics</div>
                                        <div>3️⃣ Computer Science</div>
                                        <div>4️⃣ English Literature</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-2xl font-semibold mb-4">Available Commands</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                        <code class="text-blue-600 dark:text-blue-400 font-bold">/r</code>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Class Timings</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Get the complete bell schedule</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                        <code class="text-purple-600 dark:text-purple-400 font-bold">/s</code>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Quick Schedule</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Get your schedule for today</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                        <code class="text-green-600 dark:text-green-400 font-bold">/st</code>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Schedule with Time</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Include class timings</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                    <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                                        <code class="text-orange-600 dark:text-orange-400 font-bold">/stt</code>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Full Schedule</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Include times and teachers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Schedule Section -->
        <section id="schedule" class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Class Schedule</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Quick reference for class timings and schedule structure
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Bell Schedule -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-semibold mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Bell Schedule
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">1️⃣</span>
                                    <span class="font-semibold">First Period</span>
                                </div>
                                <span class="text-blue-600 dark:text-blue-400 font-mono font-bold">8:20 - 9:40</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">2️⃣</span>
                                    <span class="font-semibold">Second Period</span>
                                </div>
                                <span class="text-purple-600 dark:text-purple-400 font-mono font-bold">9:50 - 11:10</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">3️⃣</span>
                                    <span class="font-semibold">Third Period</span>
                                </div>
                                <span class="text-green-600 dark:text-green-400 font-mono font-bold">11:40 - 13:00</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">4️⃣</span>
                                    <span class="font-semibold">Fourth Period</span>
                                </div>
                                <span class="text-orange-600 dark:text-orange-400 font-mono font-bold">13:10 - 14:30</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">5️⃣</span>
                                    <span class="font-semibold">Fifth Period</span>
                                </div>
                                <span class="text-red-600 dark:text-red-400 font-mono font-bold">14:40 - 16:00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-semibold mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                            Quick Tips
                        </h3>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">1</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">Use Command Shortcuts</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        Use <code class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">/s</code> for quick schedule,
                                        <code class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">/st</code> with times,
                                        <code class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">/stt</code> with full details.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-purple-600 dark:text-purple-400 font-bold text-sm">2</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">Flexible Date Queries</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        Ask for "today", "tomorrow", "this week", or specific dates to get targeted schedule information.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-green-600 dark:text-green-400 font-bold text-sm">3</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">Real-time Updates</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        The bot provides up-to-date information, so you'll always have the latest schedule changes.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <span class="text-orange-600 dark:text-orange-400 font-bold text-sm">4</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold mb-2">Mobile Optimized</h4>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        Access your schedule on any device through Telegram's mobile and desktop applications.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-3xl p-12 text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Get Started?</h2>
                    <p class="text-xl mb-8 opacity-90">
                        Join thousands of students who are already using our smart schedule assistant
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.21-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121L9.864 13.63l-2.91-.918c-.642-.203-.657-.64.136-.952l11.352-4.374c.538-.196 1.006.128.832.835z"/>
                            </svg>
                            Start Using Bot
                        </a>
                        <a href="#features" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-blue-600 transition-all duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold">ETI Schedule</span>
                        </div>
                        <p class="text-gray-400 mb-4 max-w-md">
                            Your intelligent university schedule assistant. Never miss a class with our smart Telegram bot integration.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.21-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121L9.864 13.63l-2.91-.918c-.642-.203-.657-.64.136-.952l11.352-4.374c.538-.196 1.006.128.832.835z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                            <li><a href="#demo" class="hover:text-white transition-colors">Demo</a></li>
                            <li><a href="#schedule" class="hover:text-white transition-colors">Schedule</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold mb-4">Commands</h3>
                        <ul class="space-y-2 text-gray-400 font-mono text-sm">
                            <li>/rings</li>
                            <li>/schedule</li>
                            <li>/s, /st, /stt</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 ETI Schedule. Built with ❤️ for students.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
