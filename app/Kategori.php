<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table ="kategori";
    protected $fillable = ["kategori"];

    public function transaksi()
    {
        //Method untuk 1 Kategori memiliki banyak Transaksi
        return $this->hasMany('App\Transaksi');
    }
}
