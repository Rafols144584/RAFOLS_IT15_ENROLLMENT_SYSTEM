<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academic Portal')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-10">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Academic<span class="text-indigo-600">Portal</span></span>
                    </a>
                    
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('students.index') }}" 
                           class="px-4 py-2 text-sm font-medium {{ Request::is('students*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} rounded-lg transition-all">
                            Students
                        </a>
                        <a href="{{ route('courses.index') }}" 
                           class="px-4 py-2 text-sm font-medium {{ Request::is('courses*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} rounded-lg transition-all">
                            Courses
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('students.create') }}" 
                       class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                        Add Student
                    </a>
                    <a href="{{ route('courses.create') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm shadow-indigo-200 transition-all active:scale-95">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Course
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 mt-6">
        @if(session('success'))
            <div class="flex items-center p-4 bg-emerald-50 border border-emerald-100 rounded-xl animate-fade-in-down">
                <div class="flex-shrink-0 w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-3 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="flex items-start p-4 bg-rose-50 border border-rose-100 rounded-xl animate-fade-in-down">
                <div class="flex-shrink-0 w-8 h-8 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-rose-800">Action Required</h3>
                    <div class="mt-1 text-sm text-rose-700">
                        @if(session('error'))
                            <p>{{ session('error') }}</p>
                        @else
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-2 grayscale opacity-60">
                    <div class="w-6 h-6 bg-slate-800 rounded flex items-center justify-center text-[10px] text-white font-bold">AP</div>
                    <span class="text-sm font-bold tracking-tight text-slate-600">Academic Portal</span>
                </div>
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Institutional Management System. All rights reserved.</p>
                <div class="flex space-x-6 text-sm font-medium text-slate-400">
                    <span class="hover:text-indigo-600 cursor-default">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                    <span class="hover:text-indigo-600 cursor-default">PHP v{{ PHP_VERSION }}</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>