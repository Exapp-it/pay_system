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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('payment_system')->unsigned();
            $table->string('details');

            $table->decimal('amount');
            $table->decimal('amount_default_currency')->default(0);
            $table->string('currency');

            $table->boolean('approved')->default(false);
            $table->boolean('canceled')->default(false);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('payment_system')
                ->references('id')
                ->on('payment_systems')
                ->onDelete('cascade');

            $table->index('user_id');
            $table->index('payment_system');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
