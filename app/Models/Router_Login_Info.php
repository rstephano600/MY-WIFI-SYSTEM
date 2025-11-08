<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Router_Login_Info extends Model
{
     protected $fillable = [
        'username',
        'password',
        'status',
        'created_by'
        'updated_by'
    ];
}
