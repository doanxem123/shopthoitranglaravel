<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->Increments('invoice_id')->primarykey();
            $table->integer('account_id');       
            $table->integer('permission_id');     //Loại khách hàng lúc hoá đơn để giảm giá
            $table->string('discount_code');        //Mã giảm giá
            $table->string('invoice_account_name');
            $table->string('invoice_account_phone');
            $table->string('invoice_account_email');
            $table->string('invoice_account_address');
            $table->text('invoice_note')->nullable();
            $table->date('invoice_date');
            $table->integer('invoice_total');
            $table->text('invoice_desc')->nullable();
            $table->integer('invoice_status');
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
        Schema::dropIfExists('tbl_invoice');
    }
}
