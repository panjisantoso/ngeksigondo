<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $table = 'tb_kehadiran';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_anggota', 'id_kegiatan', 'kehadiran', 'keterangan'
    ];
}
