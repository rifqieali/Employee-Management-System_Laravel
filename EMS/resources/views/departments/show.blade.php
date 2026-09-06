@extends('layouts.app')

@section('title', 'Department Dossier /// EMS')
@section('masthead', 'Unit File')
@section('doc-id', 'DOC / DEPT-008')
@section('doc-meta')/// READOUT /// ID: {{ $department->id }} ///@endsection

@section('content')
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12 md:col-span-8">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 008 /// UNIT FILE /// ID-{{ $department->id }}</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">{{ $department->dept_name }}</h2>
    </div>
    <div class="col-span-12 md:col-span-4 flex flex-wrap md:justify-end gap-2">
        <a href="{{ route('department.edit', $department) }}" class="btn btn-primary" id="edit-department-btn">Edit</a>
        <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<dl class="border-2 border-black bg-white max-w-3xl grid grid-cols-1 sm:grid-cols-[220px_1fr]" style="border-color: var(--ink);">
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3 border-b" style="border-color: var(--line); background: var(--paper-dim);">Department Name</dt>
        <dd class="px-4 py-3 border-b font-semibold" style="border-color: var(--line);">{{ $department->dept_name }}</dd>
    </div>
    <div class="contents">
        <dt class="font-micro text-[11px] font-semibold px-4 py-3" style="background: var(--paper-dim);">Total Employees</dt>
        <dd class="px-4 py-3 font-micro text-[12px]">{{ $department->employees->count() }} PAX</dd>
    </div>
</dl>
@endsection
