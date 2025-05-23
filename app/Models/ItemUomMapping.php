<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemUomMapping extends Model
{

    protected $table = 'item_uom_mapping';

    protected $primaryKey = 'id';

    public $timestamps = false  ;

    protected $fillable = [
        'item_id',
        'default_uom_id',
        'uom_symbol',
        'unit_quantity'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'default_uom_id');
    }
}
