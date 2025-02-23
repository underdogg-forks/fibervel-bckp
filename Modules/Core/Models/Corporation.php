<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Factories\CorporationFactory;

class Corporation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): Factory
    {
        return CorporationFactory::new();
    }
}
