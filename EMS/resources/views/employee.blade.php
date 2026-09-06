@extends('layouts.app')

@section('title', 'Employees /// EMS')
@section('masthead', 'Employees')
@section('doc-id', 'DOC / EMP-001')
@section('doc-meta')/// ROSTER /// TOTAL: {{ $employees->total() }} ///@endsection

@section('content')
{{-- /// SECTION HEADER : index numeral + action --}}
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12 md:col-span-8">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 001 /// PERSONNEL ROSTER</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">Daftar Karyawan</h2>
    </div>
    <div class="col-span-12 md:col-span-4 flex md:justify-end">
        <a href="{{ route('employee.create') }}" class="btn btn-primary" id="add-employee-btn">+ Add Employee</a>
    </div>
</div>

{{-- /// TOOL STRIP : search compartment --}}
<div class="border-2 border-black p-3 mb-0 bg-white" style="border-color: var(--ink);">
    <form method="GET" action="{{ route('employee.index') }}" class="flex flex-col sm:flex-row gap-2">
        <label for="search" class="sr-only">Search employees</label>
        <input id="search" type="text" name="search" value="{{ $search ?? request('search') }}"
               placeholder="SEARCH NAME / EMAIL / TITLE / STATUS / DEPT..."
               class="fld-input font-micro text-[12px] flex-1" style="text-transform: uppercase;" />
        <button type="submit" class="btn btn-primary">Search &gt;&gt;&gt;</button>
        @if ($search ?? request('search'))
            <a href="{{ route('employee.index') }}" class="btn btn-secondary text-center">Reset</a>
        @endif
    </form>
    @if ($search ?? request('search'))
        <p class="font-micro text-[11px] mt-2">FILTER: "{{ $search ?? request('search') }}" /// {{ $employees->total() }} RECORD(S)</p>
    @endif
</div>

{{-- /// DATA TABLE --}}
<div class="border-2 border-t-0 border-black overflow-x-auto bg-white" style="border-color: var(--ink);">
    <table class="w-full text-sm text-left">
        <thead class="tbl-head">
            <tr>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">No</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Name</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Gender</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Title</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Email</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Status</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Department</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap sticky right-0" style="background: var(--paper-dim);">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="tbl-row">
                    <td class="px-4 py-3 whitespace-nowrap font-micro text-[12px]">{{ $employees->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 whitespace-nowrap font-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $employee->gender }}</td>
                    <td class="px-4 py-3 max-w-[180px] truncate" title="{{ $employee->title }}">{{ $employee->title }}</td>
                    <td class="px-4 py-3 max-w-[220px] truncate" title="{{ $employee->email }}">{{ $employee->email }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="font-micro text-[11px] font-semibold px-2 py-1 border"
                              style="{{ $employee->emp_status === 'Active' ? 'border-color: var(--ink);' : 'border-color: var(--red); color: var(--red);' }}">{{ $employee->emp_status }}</span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $employee->department?->dept_name ?? '-' }}</td>
                    <td class="px-4 py-3 sticky right-0 bg-white" style="box-shadow: inset 1px 0 0 0 var(--line);">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                              action="{{ route('employee.destroy', $employee) }}" method="POST"
                              class="flex items-center gap-1.5 whitespace-nowrap">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('employee.show', $employee) }}" id="{{ $employee->id }}-show-btn" class="btn-outline-sm">View</a>
                            <a href="{{ route('employee.edit', $employee) }}" id="{{ $employee->id }}-edit-btn" class="btn-outline-sm" style="background: var(--ink); color: var(--paper);">Edit</a>
                            <button type="submit" class="btn-danger-sm" id="{{ $employee->id }}-delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-10 text-center">
                        <p class="font-micro text-[11px] mb-2">[ EMPTY ]</p>
                        <p class="text-lg font-bold uppercase tracking-tight mb-4">No employees found.</p>
                        <a href="{{ route('employee.create') }}" class="btn btn-primary">+ Add Employee</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- /// PAGINATION --}}
<div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-2 justify-between">
    <p class="font-micro text-[11px]">PG {{ $employees->currentPage() }} / {{ $employees->lastPage() }} /// {{ $employees->total() }} RECORDS</p>
    <div>{{ $employees->links() }}</div>
</div>
@endsection
