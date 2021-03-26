<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = "reservations";
    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }

    protected $fillable = [
        'accompany_number',
        'room_id',
        'paid_price',
    ];
}
