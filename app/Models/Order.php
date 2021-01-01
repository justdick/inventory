<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'customer_name', 'customer_phone', 'receipt_id', 'price', 'served_by', 'date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
