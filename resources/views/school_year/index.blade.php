@extends('design.adminheader')

@section('content')
<div class="container mx-auto p-4" x-data="schoolYearCrud()">

    <h1 class="text-2xl font-bold mb-6">School Years</h1>

    <!-- Add Button -->
    <button @click="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4">
        + Add School Year
    </button>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">School Year</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Semester</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($schoolYears as $sy)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $sy->school_year }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $sy->semester }}</td>
                        <td class="py-4 px-6 whitespace-nowrap flex items-center justify-center space-x-2">
                            <button @click="openEditModal({{ $sy }})" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-4 rounded-lg text-sm">
                                Edit
                            </button>
                            <button @click="openDeleteModal({{ $sy->id }})" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded-lg text-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Create/Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-md" @click.away="closeModal()">
            <h2 class="text-xl font-bold mb-4" x-text="isEdit ? 'Edit School Year' : 'Add School Year'"></h2>

            <form :action="formAction" method="POST">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="mb-4">
                    <label class="block text-gray-700">School Year</label>
                    <input type="text" name="school_year" x-model="form.school_year" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Semester</label>
                    <select name="semester" x-model="form.semester" class="w-full border px-3 py-2 rounded" required>
                        <option value="">-- Select Semester --</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="closeModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" x-text="isEdit ? 'Update' : 'Save'"></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-sm" @click.away="closeDeleteModal()">
            <h2 class="text-xl font-bold mb-4 text-center text-red-500">Confirm Delete</h2>

            <p class="text-center mb-6">Are you sure you want to delete this school year?</p>

            <form :action="deleteAction" method="POST" class="flex justify-center space-x-4">
                @csrf
                @method('DELETE')
                <button type="button" @click="closeDeleteModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </form>
        </div>
    </div>

</div>

<!-- Alpine.js Script -->
<script>
function schoolYearCrud() {
    return {
        showModal: false,
        showDeleteModal: false,
        isEdit: false,
        form: {
            school_year: '',
            semester: '',
        },
        formAction: '',
        deleteAction: '',

        openCreateModal() {
            this.isEdit = false;
            this.form = { school_year: '', semester: '' };
            this.formAction = '{{ route('school_year.store') }}';
            this.showModal = true;
        },

        openEditModal(sy) {
            this.isEdit = true;
            this.form = { school_year: sy.school_year, semester: sy.semester };
            this.formAction = `/school_year/${sy.id}`;
            this.showModal = true;
        },

        openDeleteModal(id) {
            this.deleteAction = `/school_year/${id}`;
            this.showDeleteModal = true;
        },

        closeModal() {
            this.showModal = false;
        },

        closeDeleteModal() {
            this.showDeleteModal = false;
        }
    }
}
</script>
@endsection
