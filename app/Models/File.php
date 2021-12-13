<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "creator_identifier",
        "from",
        "resource_identifier",
        "identifier",
        "status"
    ];
}
