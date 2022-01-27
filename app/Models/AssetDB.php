<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssetTypeDB;
use App\Models\AssetImage;

class AssetDB extends Model
{
    use HasFactory;

    public function assettype()
    {
        return $this->belongsTo(AssetTypeDB::class);
    }

    public function assetimage()
    {
        return $this->hasMany(AssetImage::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($assetimage) {
    //         $assetimage->assetimage()->get()->each->delete();
    //     });
    // }
}
