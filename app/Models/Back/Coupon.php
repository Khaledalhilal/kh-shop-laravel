<?php

namespace App\Models\Back;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupon';
    protected $fillable =
    [
        'code',
        'discountAmount',
        'usageCount',
        'userUsageCount',
        'minimumPurchaseAmount',
        'isActive',
        'user_id',
        'from_date',
        'to_date',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
