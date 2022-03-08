<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $table = 'book';
    protected $fillable = [
        'transaction_id',
        'bookingtype_id',
        'user_id',
        'status_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function bookProduct()
    {
        $product = Product::whereHas('book', function ($query){
            $query->whereUserId($this->id);
        })->get();
        return $product;
    }

    
}
