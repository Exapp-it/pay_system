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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();

            $table->string('title');
            $table->bigInteger('m_id')->unsigned()->unique();
            $table->text('m_key');

            $table->string('base_url');
            $table->string('success_url');
            $table->string('fail_url');
            $table->string('handler_url');

            $table->decimal('balance')->default(0);
            $table->decimal('percent')->default(config('payment.percent.default'));

            $table->boolean('approved')->default(false);
            $table->boolean('rejected')->default(false);
            $table->boolean('activated')->default(false);
            $table->boolean('banned')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->index('m_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
