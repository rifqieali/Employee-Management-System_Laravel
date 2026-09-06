@extends('layouts.app')

@section('title', 'Departments /// EMS')
@section('masthead', 'Departments')
@section('doc-id', 'DOC / DEPT-002')
@section('doc-meta')/// INDEX /// TOTAL: {{ $departments->total() }} ///@endsection

@section('content')
{{-- /// SECTION HEADER --}}
<div class="grid grid-cols-12 gap-4 items-end mb-5">
    <div class="col-span-12 md:col-span-8">
        <p class="font-micro text-[11px] mb-1"><span style="color: var(--red);">///</span> 002 /// ORG UNITS</p>
        <h2 class="font-macro" style="font-size: clamp(1.6rem, 3.5vw, 2.6rem);">Daftar Department</h2>
    </div>
    <div class="col-span-12 md:col-span-4 flex md:justify-end">
        <a href="{{ route('department.create') }}" class="btn btn-primary" id="add-department-btn">+ Add Department</a>
    </div>
</div>

{{-- /// DATA TABLE --}}
<div class="border-2 border-black overflow-x-auto bg-white" style="border-color: var(--ink);">
    <table class="w-full text-sm text-left">
        <thead class="tbl-head">
            <tr>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">No</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Department Name</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap">Total Employees</th>
                <th scope="col" class="px-4 py-3 whitespace-nowrap sticky right-0" style="background: var(--paper-dim);">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($departments as $department)
                <tr class="tbl-row">
                    <td class="px-4 py-3 whitespace-nowrap font-micro text-[12px]">{{ $departments->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $department->dept_name }}</td>
                    <td class="px-4 py-3 whitespace-nowrap font-micro text-[12px]">{{ $department->employees_count ?? $department->employees->count() }} PAX</td>
                    <td class="px-4 py-3 sticky right-0 bg-white" style="box-shadow: inset 1px 0 0 0 var(--line);">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                              action="{{ route('department.destroy', $department) }}" method="POST"
                              class="flex items-center gap-1.5 whitespace-nowrap">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('department.show', $department) }}" id="{{ $department->id }}-show-btn" class="btn-outline-sm">View</a>
                            <a href="{{ route('department.edit', $department) }}" id="{{ $department->id }}-edit-btn" class="btn-outline-sm" style="background: var(--ink); color: var(--paper);">Edit</a>
                            <button type="submit" class="btn-danger-sm" id="{{ $department->id }}-delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-10 text-center">
                        <p class="font-micro text-[11px] mb-2">[ EMPTY ]</p>
                        <p class="text-lg font-bold uppercase tracking-tight mb-4">No departments found.</p>
                        <a href="{{ route('department.create') }}" class="btn btn-primary">+ Add Department</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- /// PAGINATION --}}
<div class="mt-4 flex flex-col sm:flex-row sm:items-center gap-2 justify-between">
    <p class="font-micro text-[11px]">PG {{ $departments->currentPage() }} / {{ $departments->lastPage() }} /// {{ $departments->total() }} RECORDS</p>
    <div>{{ $departments->links() }}</div>
</div>
@endsection
