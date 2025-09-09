<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';
    protected $fillable = ['nama', 'nilai', 'hobi', 'mapel_favorit', 'cita_cita', 'hasil_ai'];
}
