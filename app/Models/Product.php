<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'transactions', 'booking_id', 'product_id');
    }

}
