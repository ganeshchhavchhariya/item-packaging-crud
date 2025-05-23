<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagingUomMapping extends Model
{
    protected $table = 'packaging_uom_mapping';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'packaging_id',
        'default_uom_id',
    ];

    public function packaging()
    {
        return $this->belongsTo(PackagingType::class, 'packaging_id');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'default_uom_id');
    }
}
