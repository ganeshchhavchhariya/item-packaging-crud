<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagingType extends Model
{
    protected $table = 'packaging_type_master';

    protected $primaryKey = 'packaging_id';

    public $timestamps = false;

    protected $fillable = [
        'packaging_name',
    ];

    public function packagingUomMapping()
    {
        return $this->hasOne(packagingUomMapping::class, 'packaging_id');
    }
}
