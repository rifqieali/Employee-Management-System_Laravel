@extends('layouts.app')

@section('title', 'Edit Department /// EMS')
@section('masthead', 'Amendment')
@section('doc-id', 'DOC / DEPT-007')
@section('doc-meta')/// FORM /// UPDATE /// ID: {{ $department->id }} ///@endsection

@section('content')
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 007 /// UNIT AMENDMENT /// ID-{{ $department->id }}</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">Edit Department</h2>
    </div>
</div>

<div class="border-2 border-black bg-white p-5 sm:p-7 max-w-3xl" style="border-color: var(--ink);">
    <form action="{{ route('department.update', $department) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-7">
            <label class="fld-label" for="dept_name">01 /// Department Name *</label>
            <input type="text" id="dept_name" name="dept_name" value="{{ old('dept_name', $department->dept_name) }}" required
                   class="fld-input">
            @error('dept_name')
                <div class="fld-error">[ ERR ] {{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-wrap gap-2 border-t-2 border-black pt-5" style="border-color: var(--ink);">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
