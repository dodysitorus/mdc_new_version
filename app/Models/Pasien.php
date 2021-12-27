<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = ['referal_id_mdc','status_pasien','nama','tanggal_lahir','usia','telephone','nama_layanan'
    ,'biaya','nama_dokter', 'cabang', 'admin'];
}
