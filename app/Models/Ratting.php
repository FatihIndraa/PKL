<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'komentar',
    ];

    // Rating.php (Model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
