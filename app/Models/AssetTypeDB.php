<?php

namespace App\Models;

use App\Http\Controllers\AssetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetDB;

class AssetTypeDB extends Model
{
    use HasFactory;

    public function asset()
    {
        return $this->hasMany(AssetDB::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($asset) {
    //         $asset->asset()->get()->each->delete();
    //     });
    // }
}
