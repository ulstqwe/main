<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
