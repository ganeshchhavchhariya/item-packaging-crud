<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item_master';

    protected $fillable = ['item_name', 'base_uom_id'];

    protected $attributes = [
        'base_uom_id' => 1, // Default to first UOM in the system
    ];

    protected $primaryKey = 'item_id';


    public function uom()
    {
        return $this->belongsTo(Uom::class, 'base_uom_id');
    }
}
