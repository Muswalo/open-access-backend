<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'barcode',
        'product_name',
        'description',
        'price',
        'quantity',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
