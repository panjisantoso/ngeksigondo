<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'tb_kecamatan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_kecamatan', 'id_kabupaten'
    ];
}
