<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = [
        'UID',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'delete',
        'gender'    ];
}
