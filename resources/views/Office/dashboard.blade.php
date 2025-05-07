@extends('design.header')

@section('content')
    <div class="flex justify-center px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 p-4 border rounded-full shadow cursor-pointer hover:bg-gray-100 mt-10 w-full max-w-2xl"
            onclick="openModal()">
            <img src="{{ Auth::user()->avatar ?? asset('images/default-profile.jpg') }}"
                class="h-10 w-10 rounded-full object-cover" alt="Profile" />
            <div class="flex-1 text-gray-600 text-sm">
                Create Announcement
            </div>
        </div>
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
            <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
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
    <!-- Announcements Feed -->
    <div class="mt-10 max-w-2xl mx-auto">
        @foreach ($announcements as $announcement)
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                <!-- Header -->
                <div class="flex items-center mb-4">
                    <img src="{{ $announcement->user->avatar ?? asset('images/default-profile.jpg') }}"
                        class="h-10 w-10 rounded-full object-cover" alt="Profile" />
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-gray-800">{{ $announcement->user->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Content -->
                <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $announcement->title }}</h4>
                <h2 class="text-md font-semibold text-gray-600 mb-4">{{ $announcement->description }}</h2>
  <!-- Footer -->
  <div class="text-xs text-gray-500">
    <p>To {{ $announcement->department }} Department</p>
    <p>Academic Year: {{ $announcement->academic_year }}</p>
    <p>Start Date: {{ $announcement->start_date }}</p>
    <p>End Date: {{ $announcement->end_date }}</p>
</div>
                <!-- Images -->
                @if ($announcement->images && count($announcement->images) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4">
                        @foreach ($announcement->images as $image)
                            <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Announcement Image" class="cursor-pointer" />
                            </a>
                        @endforeach
                    </div>
                @endif


            </div>
        @endforeach
    </div>
@endsection
