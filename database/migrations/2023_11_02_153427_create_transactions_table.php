<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('p_id')->unsigned();
            $table->float('amount');
            $table->string('currency');
            $table->boolean('confirmed')->default(false);
            $table->boolean('canceled')->default(false);

            $table->timestamps();

            $table->foreign('p_id')
                ->references('id')
                ->on('payments');

            $table->index('id');
            $table->index('p_id');
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
