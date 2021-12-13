<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "link_to",
        "password",
        "companyName",
        "role",
        "token",
        "profilePic",
        "apiLimiter",
        "status",
        "identifier",
    ];
}
