<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raw_contents', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('blueprint_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->longText('content');

            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_contents');
    }
};