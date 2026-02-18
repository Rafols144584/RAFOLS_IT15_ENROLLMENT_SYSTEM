@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Course Catalog</h1>
            <p class="text-slate-500 mt-1">Manage and monitor academic enrollment status.</p>
        </div>
        <a href="{{ route('courses.create') }}" 
           class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl shadow-sm hover:bg-indigo-700 transition-all active:scale-95">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Course
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white border-2 border-dashed border-slate-200 rounded-2xl p-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-full mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">No courses available</h3>
            <p class="text-slate-500 max-w-xs mx-auto mt-2">Get started by creating your first course module to begin student enrollment.</p>
            <a href="{{ route('courses.create') }}" class="mt-6 inline-block text-indigo-600 font-semibold hover:text-indigo-700">
                Create a course now &rarr;
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach($courses as $course)
                <div class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-indigo-300 hover:shadow-md transition-all duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <h2 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                    {{ $course->course_name }}
                                </h2>
                                @if($course->isFull())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700 uppercase tracking-wider">
                                        Full
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider">
                                        Available
                                    </span>
                                @endif
                            </div>
                            <p class="text-slate-500 font-medium text-sm">
                                Code: <span class="text-slate-700">{{ $course->course_code }}</span>
                            </p>
                            
                            <div class="mt-5 max-w-md">
                                <div class="flex justify-between items-end mb-2">
                                    <div class="flex items-center text-sm text-slate-600">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="font-bold text-slate-900">{{ $course->students_count }}</span>
                                        <span class="mx-1">/</span>
                                        <span>{{ $course->capacity }} enrolled</span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">
                                        {{ round(($course->students_count / max($course->capacity, 1)) * 100) }}%
                                    </span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="{{ $course->isFull() ? 'bg-rose-500' : 'bg-indigo-600' }} h-2 rounded-full transition-all duration-500" 
                                         style="width: {{ ($course->students_count / max($course->capacity, 1)) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('courses.show', $course) }}" 
                               class="w-full lg:w-auto text-center px-6 py-2.5 border border-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 hover:border-slate-300 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $courses->links() }}
        </div>
    @endif
</div>
@endsection