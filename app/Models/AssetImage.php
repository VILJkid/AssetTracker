<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetDB;

class AssetImage extends Model
{
    use HasFactory;

    public function assetimage()
    {
        return $this->belongsTo(AssetDB::class);
    }
}
