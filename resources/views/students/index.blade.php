<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('students.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Student
                    </a>
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Name</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Email</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Subject</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $student->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $student->email }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">{{ $student->subject->name }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300">
                                        <a href="{{ route('students.edit', $student) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 