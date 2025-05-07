@extends('design.adminheader')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Announcements</h1>
        <div class="mb-4 flex justify-end">
            <div class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="openModal()">
                Add Announcement
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">User Name
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Department</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Image
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Academic
                            Year</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Start
                            Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">End Date
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($announcements as $announcement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $announcement->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $announcement->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ Str::limit($announcement->description, 20) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $announcement->department }}</td>
                            <td class="px-6 py-4">
                                @if ($announcement->images && $announcement->images->count() > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($announcement->images as $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Announcement Image"
                                                class="w-16 h-16 object-cover rounded-md border border-gray-300" />
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $announcement->academic_year }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($announcement->start_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($announcement->end_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <button onclick="openViewModal({{ $announcement->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    View
                                </button>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div id="viewModal-{{ $announcement->id }}"
                            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                            <div
                                class="bg-white w-full max-w-2xl mx-4 rounded-lg shadow-lg p-6 overflow-y-auto max-h-[90vh]">
                                <!-- Header -->
                                <div class="flex items-center mb-4">
                                    <img src="{{ $announcement->user->avatar ?? asset('images/default-profile.jpg') }}"
                                        class="h-10 w-10 rounded-full object-cover" alt="Profile" />
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-gray-800">{{ $announcement->user->name }}
                                        </h3>
                                        <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <button onclick="closeViewModal({{ $announcement->id }})"
                                        class="ml-auto text-gray-500 hover:text-gray-800 text-2xl leading-none">&times;</button>
                                </div>

                                <!-- Content -->
                                <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $announcement->title }}</h4>
                                <h2 class="text-md font-semibold text-gray-900 mb-4">{{ $announcement->description }}</h2>

                                <!-- Footer -->
                                <div class="text-xs text-gray-500 space-y-1 mb-4">
                                    <p>To {{ $announcement->department }} Department</p>
                                    <p>Academic Year: {{ $announcement->academic_year }}</p>
                                    <p>Start Date: {{ \Carbon\Carbon::parse($announcement->start_date)->format('F j, Y') }}
                                    </p>
                                    <p>End Date: {{ \Carbon\Carbon::parse($announcement->end_date)->format('F j, Y') }}</p>
                                </div>

                                @if ($announcement->images && count($announcement->images) > 0)
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                        @foreach ($announcement->images as $image)
                                            <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank"
                                                class="flex items-center justify-center bg-gray-100 rounded-md overflow-hidden">
                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                    alt="Announcement Image"
                                                    class="max-h-60 w-auto object-contain rounded-md shadow-sm hover:opacity-90 transition" />
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>


                        <!-- Simple FadeIn Animation (Tailwind plugin or custom class) -->
                        <style>
                            @keyframes fadeIn {
                                from {
                                    opacity: 0;
                                    transform: scale(0.95);
                                }

                                to {
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            }

                            .animate-fadeIn {
                                animation: fadeIn 0.3s ease-out forwards;
                            }
                        </style>
                    @endforeach
                </tbody>
            </table>

            <script>
                function openViewModal(id) {
                    const modal = document.getElementById('viewModal-' + id);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            closeViewModal(id);
                        }
                    });
                }

                function closeViewModal(id) {
                    const modal = document.getElementById('viewModal-' + id);
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>


        </div>
        <!-- Modal Background -->
        <div id="announcementModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center s-center hidden z-50">
            <!-- Modal Box -->
            <div class="bg-white rounded-lg p-6 w-full max-w-lg sm:max-w-xl lg:max-w-2xl shadow-lg max-h-screen overflow-y-auto"
                onclick="event.stopPropagation()">
                <!-- Modal Header -->
                <div class="flex justify-between s-center mb-4">
                    <h2 class="text-lg sm:text-xl font-bold">Create Announcement</h2>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-lg">
                        &times;
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" class="w-full mt-1 p-2 border rounded" required />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="w-full mt-1 p-2 border rounded" rows="4" required></textarea>
                    </div>

                    <!-- Department -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Department</label>
                        <select name="department" class="w-full mt-1 p-2 border rounded" required>
                            <option value="" disabled selected>Select Department</option>
                            <option value="CCS">CCS - College of Computer Studies</option>
                            <option value="COE">COE - College of Engineering</option>
                            <option value="NABA">NABA - National Building Association</option>
                            <option value="ALL">All Department</option>
                        </select>
                    </div>


                    <!-- Academic Year -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                        <select name="academic_year" class="w-full mt-1 p-2 border rounded" required>
                            <option value="">Select Academic Year</option>
                            @foreach ($schoolYears as $year)
                                <option value="{{ $year->school_year . ' - ' . $year->semester }}">
                                    {{ $year->school_year . ' - ' . $year->semester }}
                                </option>
                            @endforeach

                        </select>
                    </div>



                    <!-- Start Date -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" class="w-full mt-1 p-2 border rounded" />
                    </div>

                    <!-- End Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" class="w-full mt-1 p-2 border rounded" required />
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="images[]" id="imageInput" class="mt-1" accept="image/*" multiple
                            onchange="previewImages()" />
                        <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4 hidden">
                            <!-- Preview images will be dynamically added here -->
                        </div>
                    </div>

                    <script>
                        function previewImages() {
                            const input = document.getElementById('imageInput');
                            const previewContainer = document.getElementById('imagePreviewContainer');
                            previewContainer.innerHTML = ''; // Clear previous previews

                            if (input.files) {
                                Array.from(input.files).forEach((file, index) => {
                                    const reader = new FileReader();

                                    reader.onload = function(e) {
                                        const imageWrapper = document.createElement('div');
                                        imageWrapper.classList.add('relative', 'group');

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.classList.add('w-full', 'max-h-64', 'object-cover', 'rounded', 'border');

                                        const removeButton = document.createElement('button');
                                        removeButton.type = 'button';
                                        removeButton.classList.add('absolute', 'top-2', 'right-2', 'bg-red-600', 'text-white',
                                            'rounded-full', 'p-1', 'hover:bg-red-700', 'hidden', 'group-hover:block');
                                        removeButton.innerHTML = '&times;';
                                        removeButton.onclick = function() {
                                            removeImage(index);
                                        };

                                        imageWrapper.appendChild(img);
                                        imageWrapper.appendChild(removeButton);
                                        previewContainer.appendChild(imageWrapper);
                                    };

                                    reader.readAsDataURL(file);
                                });

                                previewContainer.classList.remove('hidden');
                            }
                        }

                        function removeImage(index) {
                            const input = document.getElementById('imageInput');
                            const previewContainer = document.getElementById('imagePreviewContainer');

                            const files = Array.from(input.files);
                            files.splice(index, 1);

                            const dataTransfer = new DataTransfer();
                            files.forEach(file => dataTransfer.s.add(file));
                            input.files = dataTransfer.files;

                            previewImages(); // Re-render the previews
                        }
                    </script>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Post Announcement
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openModal() {
                const modal = document.getElementById("announcementModal");
                modal.classList.remove("hidden");
                modal.addEventListener("click", closeModal);
            }

            function closeModal() {
                const modal = document.getElementById("announcementModal");
                modal.classList.add("hidden");
                modal.removeEventListener("click", closeModal);
            }
        </script>
    </div>
@endsection
