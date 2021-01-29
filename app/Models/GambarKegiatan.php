<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarKegiatan extends Model
{
    use HasFactory;
    protected $table = 'tb_gambar_kegiatan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_kegiatan','gambar'
    ];
}
