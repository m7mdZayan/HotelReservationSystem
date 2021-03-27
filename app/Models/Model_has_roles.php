<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_has_roles extends Model
{
    use HasFactory;
    protected $table = "model_has_roles";


    protected $fillable = [
        'role_id',
        'model_type',
        'model_id',
    ];
}
