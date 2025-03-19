<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datasets_type', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('datasets_type')->insert([
            ['Description' => 'Original'],
            ['Description' => 'Preprocessed'],
            ['Description' => 'Test(unTercio)'],
            ['Description' => 'Training(unTercio)'],
            ['Description' => 'Test(RS)'],
            ['Description' => 'Training(RS)'],
            ['Description' => 'Test(K-fold)'],
            ['Description' => 'Training(K-fold)']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets_type');
    }
};
