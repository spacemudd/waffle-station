<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id('invoice_id'); // استخدام invoice_id كمعرف رئيسي
            $table->string('main_product');
            $table->string('second_product')->nullable();
            $table->date('booking_date');
            $table->date('request_date');
            $table->text('additional')->nullable();
            $table->string('fave_sauce')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ربط user_id بجدول المستخدمين
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
        Schema::dropIfExists('invoice');
    }
}
