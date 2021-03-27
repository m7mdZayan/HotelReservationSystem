<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $table = "rooms";
    
    protected $fillable = [
        'floor_id',
        'number',
        'capacity',
        'price',
        'created_by',
        'status',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_id');
    }

}
