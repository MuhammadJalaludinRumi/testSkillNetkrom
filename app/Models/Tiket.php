<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';

    protected $fillable = [
        'nama', 'alamat', 'telepon', 'email', 'jumlah', 'kode_tiket', 'status'
    ];
}
