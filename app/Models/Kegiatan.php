<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'tb_kegiatan';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'acara', 'tempat', 'tanggal', 'jammulai', 'jamselesai'
    ];
}