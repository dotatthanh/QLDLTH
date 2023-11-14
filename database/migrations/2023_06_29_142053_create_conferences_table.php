<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Ngày');
            $table->string('title')->comment('Tên hội nghị');
            $table->string('unit')->comment('Đơn vị');
            $table->integer('bridge_point')->comment('Số điểm cầu');
            $table->string('preside')->comment('Chủ trì');
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
        Schema::dropIfExists('conferences');
    }
}
