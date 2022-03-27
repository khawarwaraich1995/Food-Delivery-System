<?php

namespace App;

use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'outlet_id', 'cat_name', 'cat_desc', 'rank', 'discount_status', 'discount_name', 'discount_amount', 'discount_type',
        'image', 'status',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'item_cat_id');
    }
}
