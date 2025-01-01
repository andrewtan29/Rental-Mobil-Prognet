<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobil';
    protected $guarded = ['id'];
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
