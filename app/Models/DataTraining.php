<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model DataTraining
 * Digunakan untuk mengelola tabel data_training
 */
class DataTraining extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_training';

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'ipk',
        'penghasilan',
        'tanggungan',
        'status'
    ];

    // Nonaktifkan timestamps (karena tabel kita sederhana)
    public $timestamps = false;
}
