<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceiptItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receipt_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('good_receipt_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('good_receipt_id')->references('id')->on('good_receipts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_receipt_items');
    }
}
