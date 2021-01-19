<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'tb_kelurahan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_kelurahan', 'id_kecamatan'
    ];
}
