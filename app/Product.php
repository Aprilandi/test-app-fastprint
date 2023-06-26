<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_produk', 'nama_produk', 'harga', 'id_kategori', 'status'
    ];

    public function Kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }
}
