<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceiptItemWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('good_receipt_item_weights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('good_receipt_item_id');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedDecimal('weight', 8, 1);
            $table->boolean('is_sampling')->default(false);
            $table->enum('state', ['classification', 'done'])->nullable()->default('classification');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('good_receipt_item_id')->references('id')->on('good_receipt_items')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_receipt_item_weights');
    }
}
