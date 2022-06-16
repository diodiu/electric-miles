<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelayedOrder extends Model
{
    protected $fillable = ['expectedTimeOfDelivery', 'order_id'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
