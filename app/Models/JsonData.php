<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonData extends Model
{
    use HasFactory;

    protected $table = 'json_data';
    protected $fillable = [
        'user_id', 'code', 'data'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'code' => 'string',
        'data' => 'array',
    ];
}
