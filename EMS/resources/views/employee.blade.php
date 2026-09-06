<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Management System</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body>

<div class="container mx-auto mt-10 mb-10 px-10">
    <div class="grid grid-cols-8 gap-4 mb-4 p-5">
        <div class="col-span-4 mt-2">
            <h1 class="text-3xl font-bold">
                DAFTAR KARYAWAN
            </h1>
        </div>
        <div class="col-span-4">
            <div class="flex justify-end">
                <a href="{{ route('employee.create') }}"
                   class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                   id="add-employee-btn">Add Employee</a>
            </div>
        </div>
    </div>
    <div class="bg-white p-5 rounded shadow-sm">
        <!-- Notifikasi menggunakan flash session data -->
        @if (session('success'))
            <div class="p-3 rounded bg-green-500 text-green-100 mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('employee.index') }}" class="flex gap-2 mb-4">
            <input type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="Search name, email, title, status, department..."
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 transition duration-150 ease-in-out">Search</button>
            @if ($search ?? request('search'))
                <a href="{{ route('employee.index') }}"
                   class="px-6 py-2.5 bg-gray-300 text-gray-700 font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-400 transition duration-150 ease-in-out">Reset</a>
            @endif
        </form>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        No
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Name
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Gender
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Title
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Email
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap">
                        Department
                    </th>
                    <th scope="col" class="px-4 py-3 whitespace-nowrap sticky right-0 bg-gray-50 dark:bg-gray-700">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse ($employees as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $employees->firstItem() + $loop->index }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $employee->gender }}
                        </td>
                        <td class="px-4 py-3 max-w-[180px] truncate" title="{{ $employee->title }}">
                            {{ $employee->title }}
                        </td>
                        <td class="px-4 py-3 max-w-[220px] truncate" title="{{ $employee->email }}">
                            {{ $employee->email }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $employee->emp_status }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $employee->department?->dept_name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 sticky right-0 bg-white dark:bg-gray-800 shadow-[inset_1px_0_0_0_#e5e7eb]">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                  action="{{ route('employee.destroy', $employee) }}" method="POST"
                                  class="flex items-center gap-1 whitespace-nowrap">

                                @csrf
                                @method('DELETE')
                                <a href="{{ route('employee.show', $employee) }}" id="{{ $employee->id }}-show-btn"
                                   class="inline-block px-3 py-1.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 transition duration-150 ease-in-out">View</a>

                                <a href="{{ route('employee.edit', $employee) }}" id="{{ $employee->id }}-edit-btn"
                                   class="inline-block px-3 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 transition duration-150 ease-in-out">Edit</a>

                                <button type="submit"
                                        class="inline-block px-3 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 transition duration-150 ease-in-out"
                                        id="{{ $employee->id }}-delete-btn">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-sm text-gray-900 px-6 py-4 whitespace-nowrap" colspan="8">
                            Data Empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>


    <div class="mt-3">
        {{ $employees->links() }}
    </div>
</div>

</body>
</html>
