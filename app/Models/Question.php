<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'text',
    ];

    public function choices() {
        return $this->hasMany(Choice::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}
