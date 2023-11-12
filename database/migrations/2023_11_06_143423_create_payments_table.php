<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('m_id')->unsigned();


            $table->decimal('amount');
            $table->decimal('amount_default_currency')->default(0);
            $table->string('currency');
            $table->string('order');

            $table->bigInteger('payment_system')->unsigned()->nullable();
            $table->string('pay_screen')->nullable();

            $table->boolean('approved')->default(false);
            $table->boolean('canceled')->default(false);
            $table->timestamps();

            $table->foreign('m_id')
                ->references('m_id')
                ->on('merchants')
                ->onDelete('cascade');


            $table->foreign('payment_system')
                ->references('id')
                ->on('payment_systems')
                ->onDelete('cascade');

            $table->index('id');
            $table->index('m_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
