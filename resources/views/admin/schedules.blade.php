@extends('admin.layouts.app')

@section('content')
<div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Schedules</h1>
        <a href="{{ route('schedules.store') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Add Schedule
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200 rounded shadow">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
                <tr>
                    <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 border-b">{{ $schedule->title }}</td>
                    <td class="px-6 py-4 border-b">{{ $schedule->date}}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('schedules.update', $schedule) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('schedules.delete', $schedule) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No schedules found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection