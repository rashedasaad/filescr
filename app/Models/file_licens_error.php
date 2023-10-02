<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file_licens_error extends Model
{
    use HasFactory;

    public function active()
    {
        return $this->belongsTo(active::class);
    }
}
