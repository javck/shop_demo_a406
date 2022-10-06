<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'trade_no', 'pay_type', 'pay_at', 'status'];
    use HasFactory;

    //訂單所有商品關係函式
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity')->withTimestamps();
    }

    //Mutator
    public function getTitleAttribute()
    {
        $items = $this->items;
        $result = '';
        foreach ($items as $item) {
            $result = $result . $item->title . ',';
        }
        return $result;
    }
}
