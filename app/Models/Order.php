<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    private int $id;
    private ?\DateTime $expectedTimeOfDelivery;
    private ?string $deliveryAddress;
    private ?string $billingAddress;
    private StatusEnum $status;
    private User $customerId;

    protected $fillable = ['expectedTimeOfDelivery', 'deliveryAddress', 'billingAddress', 'customerId'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->using(OrderItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
