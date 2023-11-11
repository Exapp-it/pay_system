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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('m_id')->unsigned();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('withdrawal_id')->nullable();

            $table->decimal('amount');
            $table->string('currency');
            $table->string('type');

            $table->boolean('confirmed')->default(false);
            $table->boolean('canceled')->default(false);

            $table->timestamps();

            $table->foreign('m_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('cascade');

            $table->foreign('withdrawal_id')
                ->references('id')
                ->on('withdrawals')
                ->onDelete('cascade');

            $table->index('id');
            $table->index('m_id');
            $table->index('payment_id');
            $table->index('withdrawal_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
