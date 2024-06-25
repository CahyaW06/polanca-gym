<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHistory extends Model
{
    use HasFactory;

    protected $guarded = [
        "id"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trainingClass() {
        return $this->belongsTo(TrainingClass::class);
    }
}
