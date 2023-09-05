<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'invoice',
        'courier_name',
        'courier_service',
        'courier_cost',
        'weight',
        'grand_total',
        'status',
        'reference',
        'address'
    ];

    /**
     * transactionDetails
     *
     * @return void
     */
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->translatedFormat('l, d F Y'),
        );
    }
}
