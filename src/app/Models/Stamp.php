<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'stamps_id',
        'stamps_day',
        'work_in',
        'work_out',
        'rest_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

} 