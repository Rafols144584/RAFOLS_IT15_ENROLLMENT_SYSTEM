@extends('layouts.app')

@section('title', $student->full_name . ' - Profile')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('students.index') }}" class="group inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Student Directory
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div class="flex items-center gap-5">
                    <div class="h-20 w-20 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-3xl font-bold shadow-lg shadow-indigo-200">
                        {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $student->full_name }}</h1>
                        <p class="text-slate-500 font-mono text-lg">{{ $student->student_number }}</p>
                    </div>
                </div>
                <div class="md:text-right">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Contact Email</p>
                    <p class="text-lg font-semibold text-slate-700">{{ $student->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-indigo-50/50 border border-indigo-100 rounded-xl p-5">
                    <p class="text-indigo-600 text-xs font-bold uppercase tracking-widest mb-1">Enrolled In</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-indigo-700">{{ $student->courses->count() }}</span>
                        <span class="text-indigo-400 text-sm font-medium">Courses</span>
                    </div>
                </div>
                <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-5">
                    <p class="text-emerald-600 text-xs font-bold uppercase tracking-widest mb-1">Eligible For</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-emerald-700">{{ $availableCourses->count() }}</span>
                        <span class="text-emerald-400 text-sm font-medium">New Modules</span>
                    </div>
                </div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Member Since</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-xl font-bold text-slate-700">{{ $student->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-xl font-bold text-slate-900">Current Enrollment</h2>
                </div>
                
                <div class="p-6">
                    @if($student->courses->isEmpty())
                        <div class="py-12 text-center">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <p class="text-slate-400 italic">No active enrollments found.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($student->courses as $course)
                                <div class="group border border-slate-100 rounded-xl p-5 hover:border-indigo-200 hover:bg-indigo-50/30 transition-all flex flex-col md:flex-row justify-between md:items-center gap-4">
                                    <div>
                                        <h3 class="font-bold text-slate-900 group-hover:text-indigo-700 transition-colors">{{ $course->course_name }}</h3>
                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-xs font-mono font-bold text-slate-500">{{ $course->course_code }}</span>
                                            <span class="text-xs text-slate-400">•</span>
                                            <span class="text-xs text-slate-500">{{ $course->students->count() }}/{{ $course->capacity }} Seats Filled</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('courses.show', $course) }}" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">
                                            Details
                                        </a>
                                        <form action="{{ route('students.unenroll', [$student, $course]) }}" method="POST" onsubmit="return confirm('Unenroll student from this course?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors">
                                                Drop
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-slate-900 rounded-2xl p-6 text-white shadow-xl shadow-slate-200 sticky top-24">
                <h2 class="text-lg font-bold mb-1">New Enrollment</h2>
                <p class="text-slate-400 text-xs mb-6">Assign this student to an available course module.</p>
                
                @if($availableCourses->isEmpty())
                    <p class="text-slate-500 text-sm italic py-4 border-t border-slate-800">All available courses have been joined.</p>
                @else
                    <form action="{{ route('students.enroll', $student) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Select Module</label>
                            <select name="course_id" required class="w-full bg-slate-800 border-slate-700 text-white text-sm rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none appearance-none transition-all">
                                <option value="">Choose a course...</option>
                                @foreach($availableCourses as $course)
                                    <option value="{{ $course->id }}" @if($course->isFull()) disabled @endif>
                                        {{ $course->course_code }} - {{ $course->course_name }} 
                                        @if($course->isFull()) (FULL) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-3 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-indigo-900/20">
                            Enroll Student
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection