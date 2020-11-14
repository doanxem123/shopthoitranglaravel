<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_account', function (Blueprint $table) {
            $table->increments('account_id')->primarykey();
            $table->integer('permission_id');
            $table->string('account_account');
            $table->string('account_password');
            $table->string('account_name')->nullable();
            $table->string('account_phone')->nullable();
            $table->string('account_email')->nullable();
            $table->string('account_address')->nullable();
            $table->integer('account_status');
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
        Schema::dropIfExists('tbl_account');
    }
}
