<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'tb_pengumuman';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tgl_mulai', 'tgl_akhir', 'isi' ,'gambar1', 'gambar2', 'gambar2', 'download'
    ];
}
