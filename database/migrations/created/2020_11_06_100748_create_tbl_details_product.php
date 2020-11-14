<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDetailsProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_details_product', function (Blueprint $table) {
            $table->Increments('details_product_id')->primarykey();
            $table->integer('product_id');
            $table->integer('size_id');
            $table->text('details_product_desc');
            $table->integer('details_product_status');
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
        Schema::dropIfExists('tbl_details_product');
    }
}
