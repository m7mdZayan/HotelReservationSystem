<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = "users";

    public function manager()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
