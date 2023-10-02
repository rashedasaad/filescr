<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class script_name extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'script_id',
        'script_name',
        'script_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function active()
    {
        return $this->hasMany(active::class);
    }
}
