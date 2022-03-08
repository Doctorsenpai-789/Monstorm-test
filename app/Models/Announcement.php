<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    public $table = 'announcement';
    protected $fillable = [
        'title',
        'description'
    ];

     /**
      * Get the user that owns the Announcement
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     
}
