<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienMember extends Model
{
    use HasFactory;
    protected $table = 'pasien_members';
    protected $fillable = ['status_pasien','nama','tanggal_lahir','usia','telephone','cabang','admin'];
}
