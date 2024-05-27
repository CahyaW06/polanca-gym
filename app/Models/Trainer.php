<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trainer extends Model
{
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trainingClasses() {
        return $this->belongsToMany(TrainingClass::class, "trainer_trainingclasses", "user_id");
    }
}
