<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10)->nullable()->comment('internal code from company, maybe existing code in other application');
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('product_category_id');            
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
                        
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
