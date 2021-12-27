<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Klinik extends Model
{
    use HasFactory;
    protected $table = 'klinik';
    protected $fillable = ['nama','alamat'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
