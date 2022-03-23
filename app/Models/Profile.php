<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
   // protected $guarded = [];
    //protected $table ="profiles";
    protected $fillable = [
       // 'profile_picture'
        'name',
        'phone_number',
        'address'
    ];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
