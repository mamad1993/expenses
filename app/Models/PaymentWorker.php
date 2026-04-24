<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentWorker extends Model
{
    protected $fillable = [
        'amount',
        'date',
        'description',
    ];
}
