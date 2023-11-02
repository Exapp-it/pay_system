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
            $table->float('amount');
            $table->string('payment_system');
            $table->string('pay_screen')->nullable();
            $table->string('currency');
            $table->boolean('moderation')->default(false);
            $table->timestamps();

            $table->foreign('m_id')
                ->references('m_id')
                ->on('merchants');

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
