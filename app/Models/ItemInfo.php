<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $item_name название предмета
 * @property string $item_icon изображение предмета
 * @property string $item_id id предмета
 */
class ItemInfo extends Model
{
    protected $table = 'item_info';
    protected $fillable = ['item_name', 'item_id', 'item_icon'];
}
