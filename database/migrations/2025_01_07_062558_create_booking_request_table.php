<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_request', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('order_id'); // Order ID
            $table->string('agency'); // Agency name
            $table->string('main_product'); // Main product name
            $table->string('second_product')->nullable(); // Optional second product
            $table->string('additional')->nullable(); // Additional information
            $table->string('fav_sauce')->nullable(); // Favorite sauce
            $table->decimal('total_price', 10, 2); // Total price with two decimal places
            $table->string('customer_name'); // Customer name
            $table->string('customer_email'); // Customer email
            $table->string('customer_phone'); // Customer phone number
            $table->text('customer_address'); // Customer address
            $table->text('status'); // Customer address
            $table->date('booking_date'); // Booking date
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_request');
    }
}