<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $casts = [
        'start_at' => 'datetime:Y-m-d',
        'end_at' => 'datetime:Y-m-d',
        'kekurangan' => 'int',
    ];

    public function kamar() {
        return $this->belongsTo(Kamar::class);
    }

    public function layananKamar() {
        return $this->belongsToMany(LayananKamar::class);
    }
}
