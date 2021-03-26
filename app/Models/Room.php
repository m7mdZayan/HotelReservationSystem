<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function manager()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    protected $fillable = [
        'status',
    ];
}
