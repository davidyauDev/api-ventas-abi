<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = [
        'code',
        'customer_name',
        'customer_identification',
        'customer_email',
        'seller',
        'total_amount',
        'sale_date',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
