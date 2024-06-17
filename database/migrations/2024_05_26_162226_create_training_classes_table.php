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
        Schema::create('training_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_member');
            $table->integer('max_trainer');
            $table->integer('subs');
            $table->string('img')->nullable();
            $table->longText('desc');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_classes');
    }
};
