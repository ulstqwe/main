<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInfo extends Model
{
    protected $table = 'item_info';
    protected $fillable = ['item_name', 'item_id', 'item_icon'];
}
