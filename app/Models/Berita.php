<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'tb_berita';
    protected $primarykey = 'id_berita';
    public $timestamps = false;
    protected $fillable = [
        'judul_berita', 'isi_berita', 'tanggal_berita','id_user'
    ];
}
