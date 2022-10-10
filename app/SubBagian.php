<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubBagian extends Model
{
    protected $table = 'sub_bagian';

    protected $fillable = [
        'id', 'nama_sub_bagian'
    ];
}
