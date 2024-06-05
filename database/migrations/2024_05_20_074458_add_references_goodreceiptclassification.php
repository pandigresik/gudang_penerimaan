<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferencesGoodreceiptclassification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('good_receipt_item_classifications', function (Blueprint $table) {
            $table->unsignedBigInteger('reference')->nullable()->after('weight');
            $table->foreign('reference', 'good_receipt_item_weight_reference')->references('id')->on('good_receipt_item_weights')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('good_receipt_item_classifications', function (Blueprint $table) {            
            $table->dropForeign('good_receipt_item_weight_reference');
            $table->dropColumn('reference');
        });
    }
}
