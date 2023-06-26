<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'nama_kategori' => 'L QUEENLY',
            'deskripsi_kategori' => 'Queenly Ukuran Besar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'L MTH AKSESORIS (IM)',
            'deskripsi_kategori' => 'Aksesoris Ukuran Besar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'L MTH TABUNG (LK)',
            'deskripsi_kategori' => 'Tabung Ukuran Besar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'SP MTH SPAREPART (LK)',
            'deskripsi_kategori' => 'Sparepart Spesial',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'CI MTH TINTA LAIN (IM)',
            'deskripsi_kategori' => 'Tinta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'L MTH AKSESORIS (LK)',
            'deskripsi_kategori' => 'Aksesoris',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'nama_kategori' => 'S MTH STEMPEL (IM)',
            'deskripsi_kategori' => 'Stempel Tinta',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
