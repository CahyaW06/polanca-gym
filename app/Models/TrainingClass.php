<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingClass extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users() {
        return $this->belongsToMany(User::class, "trainingclasses_user");
    }

    public function trainers() {
        return $this->belongsToMany(Trainer::class, "trainer_trainingclasses");
    }

    public function inventories() {
        return $this->hasMany(Inventory::class, "training_class_id");
    }

    public function classHistories() {
        return $this->hasMany(ClassHistory::class);
    }
}
