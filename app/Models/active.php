<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class active extends Model
{
    use HasFactory;

    public function script_name()
    {
        return $this->belongsTo(script_name::class);
    }

    protected $fillable = [
        'script_id',
        'server_name',
        'user_id',
        'ip_server',
        'script_name',
        'script_token',
        'script_licens',
        'discord_id',
        'script_status'
    ];
}
