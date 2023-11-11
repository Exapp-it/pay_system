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
        Schema::create('p_s_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ps_id')->unsigned();

            $table->string('title');
            $table->string('value');
            $table->boolean('activated')->default(true);

            $table->bigInteger('usage_count')->unsigned()->default(0);

            $table->timestamps();

            $table->foreign('ps_id')
                ->references('id')
                ->on('payment_systems')
                ->onDelete('cascade');

            $table->index('ps_id');
            $table->index('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_s_infos');
    }
};
