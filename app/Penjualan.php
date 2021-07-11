<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


    class Penjualan extends Model
{
    protected $table = 'penjualans';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['tgl_penjualan', 'jml_barang', 'total', 'id_pembeli', 'id_barang' , 'id_pengguna'];
    public function Pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
    }

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function Pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}

