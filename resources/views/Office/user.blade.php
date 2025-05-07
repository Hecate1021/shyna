@extends('design.adminheader')
@section('content')

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Office Users</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Office Button -->
    <div class="mb-6">
        <button onclick="openAddModal()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
            + Add Office
        </button>
    </div>

    <table class="min-w-full bg-white rounded shadow border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Name</th>
                <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Email</th>
                <th class="py-3 px-4 border-b text-left text-sm font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offices as $office)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} hover:bg-gray-100">
                    <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $office->name }}</td>
                    <td class="py-3 px-4 border-b text-sm text-gray-700">{{ $office->email }}</td>
                    <td class="py-3 px-4 border-b">
                        <!-- Edit Button -->
                        <button onclick="openEditModal({{ $office->id }}, '{{ $office->name }}', '{{ $office->email }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-2 text-sm">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <button onclick="openDeleteModal({{ $office->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Office Modal -->
<div id="addModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Add New Office User</h2>
        <form action="{{ route('office.users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>
            <div class="text-sm text-gray-500 mb-4">
                <p>Default password will be <span class="font-semibold">'12345678'</span>.</p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Office Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Office User</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="editName" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="editEmail" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>


<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md text-center">
        <h2 class="text-xl font-bold mb-4">Are you sure?</h2>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-center space-x-4">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, email) {
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    const form = document.getElementById('editForm');

    // Build correct URL using Blade route + replace ID
    let url = "{{ route('office.users.update', ':id') }}";
    url = url.replace(':id', id);

    form.action = url;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}



function openDeleteModal(id) {
    const form = document.getElementById('deleteForm');

    // Build correct URL using Blade
    let url = "{{ route('office.users.destroy', ':id') }}";
    url = url.replace(':id', id);

    form.action = url;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

@endsection
