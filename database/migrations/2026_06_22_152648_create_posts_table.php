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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('blueprint_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('hook_propose');

            $table->json('body_points')->nullable();

            $table->unsignedTinyInteger('technical_readability_score')->default(0);

            $table->json('suggested_hashtags')->nullable();

            $table->text('tone_compliance_justification')->nullable();

            $table->enum('status', [
                'draft',
                'posted',
                'archived'
            ])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};