<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'penggunas';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = ['nama_pengguna', 'alamat', 'no_tlp'];

}
