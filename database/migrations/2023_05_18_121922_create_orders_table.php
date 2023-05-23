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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('set null');

            $table->string('user_email'); 
            $table->string('user_name'); 
            $table->string('user_address');
            $table->string('user_phone'); 
            $table->string('delivery_fee')->default(0); 
            $table->integer('subtotal');
            $table->integer('total'); 
            $table->string('payment_gateway')->default('pay_stack');
            $table->string('status')->default('processing');
            $table->string('code')->nullable();
            $table->boolean('returned')->default(false);
            $table->boolean('shipped')->default(false); 
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
