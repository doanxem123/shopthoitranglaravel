<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDetailsInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_details_invoice', function (Blueprint $table) {
            $table->Increments('details_invoice_id')->primarykey();
            $table->integer('invoice_id');
            $table->integer('details_product_id');
            $table->integer('details_invoice_quantity');
            $table->integer('details_invoice_price');
            $table->text('details_invoice_desc')->nullable();
            $table->integer('details_invoice_status');
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
        Schema::dropIfExists('tbl_details_invoice');
    }
}
