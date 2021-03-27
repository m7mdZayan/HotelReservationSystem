<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = "users";


    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'status',
        'created_by',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
