<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $table = 'tb_jenis_layanan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_layanan', 'status'
    ];
}
