<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * “This is an Eloquent model connected to a Notes database table.”
*/
class Note extends Model
{
    protected $fillable = [
        'order_number',
        'message',
        'author',
    ];
}
