<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('good_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id');
            $table->date('receipt_date');
            $table->enum('state', ['weighing', 'classification', 'done'])->nullable()->default('weighing');
            $table->string('description')->nullable()->comment('as note');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('partner_id')->references('id')->on('partners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_receipts');
    }
}
