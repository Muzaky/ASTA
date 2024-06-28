<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Tunanetra extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tunanetra';
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
        'no_hp',
        'nama_wali',
        'nomor_wali',
        'email',
        'password',
    ];
}
