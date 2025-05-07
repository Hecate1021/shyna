<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'department',
        'image',
        'academic_year',
        'start_date',
        'end_date',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

    // In Announcement model (Announcement.php)
public function images()
{
    return $this->hasMany(ImageUpload::class);  // Adjust the model name accordingly
}

}
