<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'nama_kategori', 'deskripsi_kategori'
    ];

    public function Produk()
    {
        return $this->hasMany(Product::class, 'id_kategori', 'id');
    }
}
