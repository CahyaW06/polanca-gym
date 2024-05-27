<?php

use App\Models\Trainer;
use App\Models\TrainingClass;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainer_trainingclasses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TrainingClass::class);
            $table->foreignIdFor(Trainer::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_trainingclasses');
    }
};
