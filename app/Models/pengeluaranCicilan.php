<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaranCicilan extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_member';
    protected $fillable = ['id_member','id_pembayaran'];
}
