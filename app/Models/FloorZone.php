<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloorZone extends Model
{
    protected $fillable = ['name', 'dims', 'desc', 'status', 'sort_order'];

    protected function casts(): array
    {
        return ['status' => 'boolean', 'sort_order' => 'integer'];
    }
}
