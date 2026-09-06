@extends('layouts.app')

@section('title', 'Employee Dossier /// EMS')
@section('masthead', 'Dossier')
@section('doc-id', 'DOC / EMP-005')
@section('doc-meta')/// READOUT /// ID: {{ $employee->id }} ///@endsection

@section('content')
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12 md:col-span-8">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 005 /// PERSONNEL DOSSIER /// ID-{{ $employee->id }}</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">{{ $employee->full_name }}</h2>
    </div>
    <div class="col-span-12 md:col-span-4 flex flex-wrap md:justify-end gap-2">
        <a href="{{ route('employee.edit', $employee) }}" class="btn btn-primary" id="edit-employee-btn">Edit</a>
        <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<dl class="border-2 border-black bg-white max-w-3xl grid grid-cols-1 sm:grid-cols-[220px_1fr]" style="border-color: var(--ink);">
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b bg-white" style="border-color: var(--line); background: var(--paper-dim);">Employee Name</dt>
        <dd class="px-4 py-3 border-b font-semibold" style="border-color: var(--line);">{{ $employee->full_name }}</dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b" style="border-color: var(--line); background: var(--paper-dim);">Gender</dt>
        <dd class="px-4 py-3 border-b" style="border-color: var(--line);">{{ $employee->gender }}</dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b" style="border-color: var(--line); background: var(--paper-dim);">Title</dt>
        <dd class="px-4 py-3 border-b" style="border-color: var(--line);">{{ $employee->title }}</dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b" style="border-color: var(--line); background: var(--paper-dim);">Email</dt>
        <dd class="px-4 py-3 border-b break-all" style="border-color: var(--line);">{{ $employee->email }}</dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b" style="border-color: var(--line); background: var(--paper-dim);">Status</dt>
        <dd class="px-4 py-3 border-b" style="border-color: var(--line);">
            <span class="font-micro text-[11px] font-semibold px-2 py-1 border"
                  style="{{ $employee->emp_status === 'Active' ? 'border-color: var(--ink);' : 'border-color: var(--red); color: var(--red);' }}">{{ $employee->emp_status }}</span>
        </dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3" style="background: var(--paper-dim);">Department</dt>
        <dd class="px-4 py-3">{{ $employee->department?->dept_name ?? 'N/A' }}</dd>
    </div>
</dl>
@endsection
