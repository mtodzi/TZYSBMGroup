<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); 
            $table->string('code', 255);
            $table->bigInteger('shipment_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('shipment_id')
                ->references('id')->on('shipments')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_shipment_id_foreign');
        });
        Schema::dropIfExists('items');
    }
}
