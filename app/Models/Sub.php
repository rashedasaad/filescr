<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sup_id',
        'product_id',
        'first_invoices_id',
        'first_payment_intent_id',
        'will_end'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
