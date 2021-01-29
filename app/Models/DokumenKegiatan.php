<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKegiatan extends Model
{
    use HasFactory;
    protected $table = 'tb_dokumen_kegiatan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_kegiatan','dokumen'
    ];
}
