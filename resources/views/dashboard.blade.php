@extends('design.userheader')
@section('content')

<!-- User Feed: Styled like a social media feed -->
<div class="mt-10 max-w-2xl mx-auto">
    @foreach ($announcements as $announcement)
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <!-- Header -->
            <div class="flex items-center mb-4">
                <img src="{{ $announcement->user->avatar ?? asset('images/default-profile.jpg') }}"
                    class="h-12 w-12 rounded-full object-cover" alt="Profile" />
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-gray-800">{{ $announcement->user->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Content -->
            <div class="mb-4">
                <h4 class="text-lg font-bold text-gray-800">{{ $announcement->title }}</h4>
                <p class="text-sm text-gray-700">{{ $announcement->description }}</p>
            </div>

            <!-- Images -->
            @if ($announcement->images && count($announcement->images) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    @foreach ($announcement->images as $image)
                        <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                            <!-- Changed 'object-cover' to 'object-contain' to show full image -->
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Announcement Image"
                                class="cursor-pointer rounded-lg object-contain w-full h-64" />
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Footer -->
            <div class="border-t pt-2 text-xs text-gray-500">
                <p><span class="font-semibold">Department:</span> {{ $announcement->department }}</p>
                <p><span class="font-semibold">Start Date:</span> {{ $announcement->start_date }}</p>
                <p><span class="font-semibold">End Date:</span> {{ $announcement->end_date }}</p>
                <p><span class="font-semibold">Academic Year:</span> {{ $announcement->academic_year }}</p>
            </div>
        </div>
    @endforeach
</div>

@endsection
