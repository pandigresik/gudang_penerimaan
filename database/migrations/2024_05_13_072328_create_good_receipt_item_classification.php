<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceiptItemClassification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receipt_item_classifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('good_receipt_item_id');
            $table->unsignedBigInteger('product_id');            
            $table->unsignedDecimal('weight', 8, 1);            
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('good_receipt_item_id')->references('id')->on('good_receipt_items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_receipt_item_classifications');
    }
}
