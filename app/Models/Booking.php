<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

     protected $guarded = [];
    //  protected $table = 'bookings';
    protected $fillable = [
        'quantity',
        'booking_type',
        'status',
        'phone_number',
        'address',
        'user_id',
        'delivery_date',
        'pickup_date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transactions')->withTimestamps();
    }
    
}
