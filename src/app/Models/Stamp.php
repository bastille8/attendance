<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Rest;


class Stamp extends Model
{
    use HasFactory;

    protected $fillable = [
        'stamps_id',
        'stamps_day',
        'work_in',
        'work_out',
        'work_time',
        'rests_time',
    ];

    public function down()
    {
        Schema::dropIfExists('stamps');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timestamp()
    {
        return $this->hasMany(Rest::class);
    }

}
