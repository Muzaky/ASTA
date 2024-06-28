<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Relawan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'relawan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_depan',
        'nama_belakang',
        'umur',
        'jenis_kelamin',
        'nik',
        'kecamatan',
        'alamat',
        'email',
        'no_hp',
    ];
}
