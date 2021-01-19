<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'tb_kabupaten';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_kabupaten'
    ];
}
