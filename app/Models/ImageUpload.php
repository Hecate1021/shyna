<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $fillable = [
        'announcement_id',
        'image_path',
    ];

    public function announcement()
{
    return $this->belongsTo(Announcement::class);  // Ensure the foreign key is properly set in the table
}
}
