<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongan';

    protected $fillable = [
        'id', 'nama_golongan', 'sub_bagian_id'
    ];

    public function subBagian()
    {
        return $this->belongsTo(SubBagian::class, 'sub_bagian_id', 'id');
    }
}
