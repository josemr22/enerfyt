<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('doc_number')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('reference')->nullable();
            $table->string('detail')->nullable();
            $table->boolean('delivery')->default(false);
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreign('destination_id')
                ->references('id')
                ->on('destinations')
                ->onDelete('set null');
            $table->float('tariff')->nullable();
            $table->string('pay_method');
            $table->string('payment_method_id')->nullable();
            $table->string('state');
            $table->float('total');
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
