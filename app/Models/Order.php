<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'status_id',
    ];

    public function orderstatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id','id');
    }
}
