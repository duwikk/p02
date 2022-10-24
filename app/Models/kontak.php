<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontak extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_jenis',
        'deskripsi'
    ];

    protected $table = 'jenis_kontak_siswa';
    public function siswa(){
        return $this->belongsTo('app\models\siswa','id');
    }
    // public function kontak(){
    //     return $this->belongsTo('app\models\jenis_kontak','id_jenis');
    // }
}
