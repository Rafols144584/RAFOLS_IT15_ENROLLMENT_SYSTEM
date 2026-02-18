@extends('layouts.app')

@section('title', $course->course_name . ' - Details')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('courses.index') }}" class="group inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Catalog
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $course->course_name }}</h1>
                        @if($course->isFull())
                            <span class="px-3 py-1 bg-rose-100 text-rose-700 text-xs font-bold rounded-full tracking-wider uppercase">Full Capacity</span>
                        @else
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full tracking-wider uppercase">{{ $course->available_slots }} Slots Open</span>
                        @endif
                    </div>
                    <p class="text-slate-500 mt-2 text-lg">Course Identifier: <span class="font-mono font-bold text-slate-700">{{ $course->course_code }}</span></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Enrolled</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-indigo-600">{{ $course->students->count() }}</span>
                        <span class="text-slate-400 text-sm font-medium">Students</span>
                    </div>
                </div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Total Limit</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-slate-800">{{ $course->capacity }}</span>
                        <span class="text-slate-400 text-sm font-medium">Seats</span>
                    </div>
                </div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1">Available</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold {{ $course->isFull() ? 'text-rose-500' : 'text-emerald-600' }}">
                            {{ $course->available_slots }}
                        </span>
                        <span class="text-slate-400 text-sm font-medium">Vacancies</span>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-semibold text-slate-700">Course Saturation</span>
                    <span class="text-sm font-bold text-indigo-600">
                        {{ $course->capacity > 0 ? round(($course->students->count() / $course->capacity) * 100, 1) : 0 }}%
                    </span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-3">
                    <div class="h-3 rounded-full transition-all duration-700 shadow-sm {{ $course->isFull() ? 'bg-rose-500' : 'bg-indigo-600' }}" 
                         style="width: {{ $course->capacity > 0 ? ($course->students->count() / $course->capacity * 100) : 0 }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h2 class="text-xl font-bold text-slate-900">Enrolled Students</h2>
            <span class="bg-white px-3 py-1 border border-slate-200 rounded-lg text-xs font-bold text-slate-500 shadow-sm">
                {{ $course->students->count() }} Total
            </span>
        </div>
        
        <div class="overflow-x-auto">
            @if($course->students->isEmpty())
                <div class="p-12 text-center">
                    <p class="text-slate-400 italic">No students currently enrolled.</p>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Student ID</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Full Name</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Email Address</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Enrolled On</th>
                            <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Management</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($course->students as $student)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-4 text-sm font-mono font-bold text-slate-700">{{ $student->student_number }}</td>
                                <td class="px-8 py-4 text-sm font-semibold text-slate-900">{{ $student->full_name }}</td>
                                <td class="px-8 py-4 text-sm text-slate-500">{{ $student->email }}</td>
                                <td class="px-8 py-4 text-sm text-slate-500">{{ $student->pivot->created_at->format('M d, Y') }}</td>
                                <td class="px-8 py-4 text-sm text-right space-x-4">
                                    <a href="{{ route('students.show', $student) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors">Profile</a>
                                    <form action="{{ route('courses.removeStudent', [$course, $student]) }}" method="POST" class="inline" onsubmit="return confirm('Unenroll {{ $student->full_name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-rose-600 font-semibold transition-colors">Unenroll</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="bg-slate-900 rounded-2xl p-8 text-white shadow-xl shadow-slate-200">
        <h2 class="text-xl font-bold mb-2">Quick Enrollment</h2>
        <p class="text-slate-400 text-sm mb-6">Register a new student into this course module instantly.</p>
        
        @if($course->isFull())
            <div class="bg-rose-500/10 border border-rose-500/20 rounded-xl p-4 flex items-center gap-3">
                <svg class="w-5 h-5 text-rose-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                <p class="text-rose-200 text-sm font-medium">Waitlist only: Course has reached the maximum capacity of {{ $course->capacity }}.</p>
            </div>
        @elseif($availableStudents->isEmpty())
            <p class="text-slate-500 text-sm italic">No unrolled students found in the database.</p>
        @else
            <form action="{{ route('courses.enrollStudent', $course) }}" method="POST" class="flex flex-col md:flex-row gap-4">
                @csrf
                <div class="flex-1">
                    <select name="student_id" required class="w-full bg-slate-800 border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all">
                        <option value="">Select a student to enroll...</option>
                        @foreach($availableStudents as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->student_number }} — {{ $student->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-xl font-bold transition-all active:scale-95 shadow-lg shadow-indigo-900/20">
                    Confirm Enrollment
                </button>
            </form>
        @endif
    </div>
</div>
@endsection