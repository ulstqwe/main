<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $item_name название предмета
 * @property string $item_id id предмета
 * @property string $user_id id пользователя
 */
class favourites extends Model
{
    protected $table = 'favourites';

    protected $fillable = [
        'user_id',
        'item_id',
        'item_name'
    ];

    /*
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(ItemInfo::class);
    }
    */



}
