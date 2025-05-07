<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Announcement</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>{{ $announcement->title }}</h2>

    <p><strong>Description:</strong></p>
    <p>{{ $announcement->description }}</p>

    <p><strong>Department:</strong> {{ $announcement->department }}</p>


    @if ($announcement->start_date)
        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($announcement->start_date)->format('F d, Y') }}</p>
    @endif

    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($announcement->end_date)->format('F d, Y') }}</p>

    @if ($announcement->images && $announcement->images->count())
        <hr>
        <h4>Attached Images:</h4>
        @foreach ($announcement->images as $image)
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Announcement Image"
                     style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 4px;">
            </div>
        @endforeach
    @endif
    <p><strong>Academic Year:</strong> {{ $announcement->academic_year }}</p>
    <hr>
    <p>Thank you.</p>
</body>
</html>
