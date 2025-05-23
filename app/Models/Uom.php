<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{

    protected $table = 'uom_master';

    protected $primaryKey = 'uom_id';

    public $timestamps = false;

    protected $fillable = [
        'uom_name',
        'symbol'
    ];

    protected $attributes = [
        'symbol' => ''
    ];

    public function itemUomMappings()
    {
        return $this->hasMany(itemUomMapping::class, 'default_uom_id');
    }

    public function packagingUomMappings()
    {
        return $this->hasMany(packagingUomMapping::class, 'default_uom_id');
    }

}
