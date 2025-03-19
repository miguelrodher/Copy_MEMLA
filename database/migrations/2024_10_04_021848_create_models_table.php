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
        Schema::create('models', function (Blueprint $table) {
            $table->id();

            $table->integer('test_dataset_id');
            $table->integer('training_dataset_id');
            $table->string('model_path')->unique();
            $table->integer('status');

            $table->unsignedBigInteger('model_type_id')->nullable();
            $table->foreign('model_type_id')->references('id')->on('models_type')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
