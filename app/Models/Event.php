<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'date_time', 'location',
        'category_id', 'user_id', 'max_attendees', 'ticket_price'
    ];

    // An event belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // An event belongs to an organizer (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

