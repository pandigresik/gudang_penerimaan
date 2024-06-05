<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSampleGoodReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('good_receipts', function (Blueprint $table) {            
            $table->string('sample', 20)->after('receipt_date')->nullable()->comment('nomer sample');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('good_receipts', function (Blueprint $table) {            
            $table->dropColumn('sample'); 
        });
    }
}
