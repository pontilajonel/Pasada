<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_userid',
        'driver_userid',
        'loc_id',
        'status',
        'pickup',
        'passengernumber',
        'payment'
    ];

    // public function studentuser()
    // {
    //     return $this->belongsTo(User::class, 'student_userid','id');
    // }

    // public function driveruser()
    // {
    //     return $this->belongsTo(User::class, 'driver_userid','id');
    // }
    // public function location()
    // {
    //     return $this->belongsTo(Locations::class, 'loc_id','id');
    // }

}
