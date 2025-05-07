
@extends('design.adminheader')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Top Bar with Title -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Account List</h2>
    </div>

    <!-- Department Filter Buttons (under the H2) -->
    <div class="flex flex-wrap justify-start mb-6 space-x-2">
        <a href="{{ route('admin.account.list', ['department' => 'CCS']) }}"
            class="inline-block py-2 px-4 rounded-lg text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 {{ request('department') == 'CCS' ? 'bg-green-700' : 'bg-green-500' }}">
            CCS
        </a>
        <a href="{{ route('admin.account.list', ['department' => 'COE']) }}"
            class="inline-block py-2 px-4 rounded-lg text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 {{ request('department') == 'COE' ? 'bg-orange-700' : 'bg-orange-500' }}">
            COE
        </a>
        <a href="{{ route('admin.account.list', ['department' => 'NABA']) }}"
            class="inline-block py-2 px-4 rounded-lg text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 {{ request('department') == 'NABA' ? 'bg-blue-700' : 'bg-blue-500' }}">
            NABA
        </a>
        <a href="{{ route('admin.account.list') }}"
            class="inline-block py-2 px-4 rounded-lg bg-gray-500 text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            All
        </a>
    </div>

    <!-- Account List Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg mb-6">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-600">Position</th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-600">Department</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ $user->position }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ $user->department }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-6 py-4 border-b border-gray-200 text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
