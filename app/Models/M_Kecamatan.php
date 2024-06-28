<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Kecamatan extends Model
{
    protected $table = 'kecamatan';
    
    use HasFactory;
    
    public function show(){
        return DB::table('kecamatan');
    }
}
