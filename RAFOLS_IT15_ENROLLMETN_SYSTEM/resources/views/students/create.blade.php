@extends('layouts.app')

@section('title', 'Create New Student')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('students.index') }}" class="group inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Student List
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
            <h1 class="text-2xl font-bold text-slate-900">Register New Student</h1>
            <p class="text-slate-500 text-sm mt-1">Enter the student's personal information to create their academic profile.</p>
        </div>

        <form action="{{ route('students.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="student_number" class="block text-sm font-semibold text-slate-700 mb-2">
                        Student Number <span class="text-indigo-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="student_number" 
                               id="student_number" 
                               value="{{ old('student_number') }}"
                               placeholder="e.g., 2024-0001"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none font-mono @error('student_number') border-red-500 bg-red-50 @enderror">
                    </div>
                    @error('student_number')
                        <p class="text-red-500 text-xs mt-2 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-slate-700 mb-2">
                            First Name <span class="text-indigo-500">*</span>
                        </label>
                        <input type="text" 
                               name="first_name" 
                               id="first_name" 
                               value="{{ old('first_name') }}"
                               placeholder="John"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('first_name') border-red-500 bg-red-50 @enderror">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Last Name <span class="text-indigo-500">*</span>
                        </label>
                        <input type="text" 
                               name="last_name" 
                               id="last_name" 
                               value="{{ old('last_name') }}"
                               placeholder="Doe"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('last_name') border-red-500 bg-red-50 @enderror">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email Address <span class="text-indigo-500">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           placeholder="john.doe@university.edu"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('email') border-red-500 bg-red-50 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-slate-100">
                <a href="{{ route('students.index') }}" 
                   class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md shadow-indigo-200 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all active:scale-95">
                    Create Student Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection