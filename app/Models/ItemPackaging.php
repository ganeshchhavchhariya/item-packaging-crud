<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPackaging extends Model
{
    protected $table = 'item_packaging_master';

    protected $primaryKey = 'item_pack_id';

    public $timestamps = true;

    protected $fillable = [
        'item_id',
        'packaging_id',
        'uom_id',
        'units_per_pack',
        'unit_quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function packaging()
    {
        return $this->belongsTo(PackagingType::class, 'packaging_id', 'packaging_id');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id', 'uom_id');
    }
}
