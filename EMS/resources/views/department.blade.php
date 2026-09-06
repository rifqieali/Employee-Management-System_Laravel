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
                DAFTAR DEPARTMENT
            </h1>
        </div>
        <div class="col-span-4">
            <div class="flex justify-end">
                <a href="{{ route('department.create') }}"
                   class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                   id="add-department-btn">Add Department</a>
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
        @if (session('error'))
            <div class="p-3 rounded bg-red-500 text-red-100 mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Department Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Employees
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse ($departments as $department)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">
                            {{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $department->dept_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $department->employees_count ?? $department->employees->count() }}
                        </td>
                        <td class="px-6 py-4">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                  action="{{ route('department.destroy', $department) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <a href="{{ route('department.show', $department) }}" id="{{ $department->id }}-show-btn"
                                   class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">View</a>

                                <a href="{{ route('department.edit', $department) }}" id="{{ $department->id }}-edit-btn"
                                   class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">Edit</a>

                                <button type="submit"
                                        class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                        id="{{ $department->id }}-delete-btn">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center text-sm text-gray-900 px-6 py-4 whitespace-nowrap" colspan="4">
                            Data Empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>


    <div class="mt-3">
        {{ $departments->links() }}
    </div>
</div>

</body>
</html>
