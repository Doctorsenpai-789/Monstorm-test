<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    use HasFactory;
    public $table='usertype';
    protected $fillable = [
        'usertype'
        
    ];
}