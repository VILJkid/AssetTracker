<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_d_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('assetname');
            $table->bigInteger('assetcode')->unique();
            $table->string('assetstatus');
            $table->foreignId('assettype_id')->constrained('asset_type_d_b_s')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_d_b_s');
    }
}
