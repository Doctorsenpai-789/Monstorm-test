<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserType;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'password',
        'address',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function book()
    {
        return $this->hasMany(Book::class)->orderBy('created_at', 'DESC');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }



    // public function getUserTypeRelation(){
    //     return $this->hasOne(related: 'App\Model\Usertype',  foreignKey: 'user_id', localKey: 'id');
    // }


    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function getUserTypeRelation()
    // {
    //     return $this->hasOne(UserType::class, 'user_id', 'id');
    // }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($user) {
    //         $user->usertype()->create([
    //             'usertypename' => $user->name
    //         ]);
    //     });
    // }

    // public function usertype()
    // {
    //     return $this->hasOne(UserType::class);
    // }
}
