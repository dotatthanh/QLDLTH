<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->integer('station_id')->unique();
            $table->integer('region_id');
            $table->string('ip_address');
            $table->string('subnet');
            $table->string('gateway');
            $table->string('vlan');
            $table->string('swl2_transmission')->comment('SWL2 truyền dẫn');
            $table->string('swl2_security')->comment('SWL2 bảo mật');
            $table->string('swl3');
            $table->string('coordinates_origin')->comment('Toạ độ đầu gần');
            $table->string('coordinates_remote')->nullable()->comment('Toạ độ truyền dẫn đầu xa');
            $table->string('level')->nullable()->comment('Cấp');
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
        Schema::dropIfExists('test');
    }
}
