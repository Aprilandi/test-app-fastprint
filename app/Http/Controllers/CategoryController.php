<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::get();
        return view('category.index')->with(['sideCategory' => 'active', 'pageName' => 'Kategori', 'pageTitle' => 'Test-App Pengelolahan Kategori', 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            $categories = Category::create([
                'nama_kategori' => strtoupper($request->inputNama),
                'deskripsi_kategori' => strtoupper($request->inputDeskripsi),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $response = ['success' => 'Data Berhasil Ditambah!'];
        } catch (\Exception $e) {
            $response = ['errors' => $e];
        }

        return redirect()->route('kategori.index')->with($response);
    }

    public function update(Request $request, $id)
    {
        try {
            $categories = Category::find($id)->update([
                'nama_kategori' => strtoupper($request->inputedNama),
                'deskripsi_kategori' => strtoupper($request->inputedDeskripsi),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $response = ['success' => 'Data Berhasil Dirubah!'];
        } catch (\Exception $e) {
            $response = ['errors' => $e];
        }

        return redirect()->route('kategori.index')->with($response);
    }

    public function destroy($id)
    {
        try {
            $categories = Category::find($id);
            $categories->delete();
            $response = ['success' => 'Data Berhasil Dihapus!'];
        } catch (\Exception $e) {
            $response = ['errors' => $e];
        }

        return redirect()->route('kategori.index')->with($response);
    }
}
