<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "password",
        "companyName",
        "role",
        "token",
        "profilePic",
        "apiLimiter",
        "verificationCode",
        "shareCount",
        "status",
        "identifier"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}
