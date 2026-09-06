@extends('layouts.app')

@section('title', 'New Employee /// EMS')
@section('masthead', 'New Entry')
@section('doc-id', 'DOC / EMP-003')
@section('doc-meta', '/// FORM /// CREATE ///')

@section('content')
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 003 /// PERSONNEL INTAKE</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">Create New Employee</h2>
    </div>
</div>

<div class="border-2 border-black bg-white p-5 sm:p-7 max-w-3xl" style="border-color: var(--ink);">
    <form action="{{ route('employee.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
            <div>
                <label class="fld-label" for="first_name">01 /// First Name *</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                       class="fld-input" autocomplete="given-name">
                @error('first_name')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="fld-label" for="last_name">02 /// Last Name *</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required
                       class="fld-input" autocomplete="family-name">
                @error('last_name')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
            <div>
                <label class="fld-label" for="gender">03 /// Gender *</label>
                <select id="gender" name="gender" required class="fld-input">
                    <option value="">-- Select Gender --</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="fld-label" for="title">04 /// Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="fld-input" placeholder="e.g. Production Technician I">
                @error('title')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-5">
            <label class="fld-label" for="email">05 /// Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="fld-input" autocomplete="email" placeholder="name@example.com">
            @error('email')
                <div class="fld-error">[ ERR ] {{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-7">
            <div>
                <label class="fld-label" for="emp_status">06 /// Status *</label>
                <input type="text" id="emp_status" name="emp_status" value="{{ old('emp_status') }}" required
                       class="fld-input" placeholder="e.g. Active">
                @error('emp_status')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="fld-label" for="department_id">07 /// Department *</label>
                <select id="department_id" name="department_id" required class="fld-input">
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->dept_name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="fld-error">[ ERR ] {{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-2 border-t-2 border-black pt-5" style="border-color: var(--ink);">
            <button type="submit" class="btn btn-primary">Save Record</button>
            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
