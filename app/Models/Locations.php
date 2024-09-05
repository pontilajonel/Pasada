<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = [
        'destinations',
        'number',
    ];
    // public function loc()
    // {
    //     return $this->hasMany(Transactions::class, 'loc_id');
    // }
}
