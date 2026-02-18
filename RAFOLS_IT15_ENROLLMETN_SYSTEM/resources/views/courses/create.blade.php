@extends('layouts.app')

@section('title', 'Create New Course')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('courses.index') }}" class="group inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Course Catalog
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
            <h1 class="text-2xl font-bold text-slate-900">Create New Course</h1>
            <p class="text-slate-500 text-sm mt-1">Fill in the details below to establish a new academic module.</p>
        </div>

        <form action="{{ route('courses.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="course_code" class="block text-sm font-semibold text-slate-700 mb-2">
                        Course Code <span class="text-indigo-500">*</span>
                    </label>
                    <input type="text" 
                           name="course_code" 
                           id="course_code" 
                           value="{{ old('course_code') }}"
                           placeholder="e.g., CS101"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('course_code') border-red-500 bg-red-50 @enderror">
                    @error('course_code')
                        <p class="text-red-500 text-xs mt-2 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="course_name" class="block text-sm font-semibold text-slate-700 mb-2">
                        Course Name <span class="text-indigo-500">*</span>
                    </label>
                    <input type="text" 
                           name="course_name" 
                           id="course_name" 
                           value="{{ old('course_name') }}"
                           placeholder="e.g., Introduction to Computer Science"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('course_name') border-red-500 bg-red-50 @enderror">
                    @error('course_name')
                        <p class="text-red-500 text-xs mt-2 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-semibold text-slate-700 mb-2">
                        Student Capacity <span class="text-indigo-500">*</span>
                    </label>
                    <div class="relative max-w-[200px]">
                        <input type="number" 
                               name="capacity" 
                               id="capacity" 
                               value="{{ old('capacity', 30) }}"
                               min="1"
                               max="500"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none @error('capacity') border-red-500 bg-red-50 @enderror">
                    </div>
                    <p class="text-slate-400 text-xs mt-2 italic">Acceptable range: 1 - 500 students</p>
                    @error('capacity')
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-slate-100">
                <a href="{{ route('courses.index') }}" 
                   class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md shadow-indigo-200 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all active:scale-95">
                    Create Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection