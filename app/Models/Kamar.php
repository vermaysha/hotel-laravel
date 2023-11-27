<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $cast = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'jenis_kamar',
        'tipe_tempat_tidur',
        'tarif_awal',
        'ukuran_kamar',
        'kapasitas_kamar',
        'rincian_kamar',
        'detail_kamar',
        'tarif_id'
    ];

    //protected $guarded = ['id'];

    public function tarifs()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id'); //bagian ini
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }
}
