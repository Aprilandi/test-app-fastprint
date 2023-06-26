<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function index()
    {
        $category = Category::get();
        $products = Product::where('status', 'bisa dijual')->get();
        return view('product.index')->with(['sideProduct' => 'active', 'pageName' => 'Produk', 'pageTitle' => 'Test-App Pengelolahan Produk', 'products' => $products, 'categories' => $category]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inputNama' => 'required',
            'inputHarga' => 'numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $product = new Product;

                $product->nama_produk = strtoupper($request->inputNama);
                $product->harga = $request->inputHarga;
                $product->id_kategori = $request->inputKategori;
                $product->status = strtolower($request->inputStatus);

                $product->save();

                DB::commit();

                $response = ['success' => 'Data Berhasil Ditambah!'];
            } catch (\Exception $e) {
                DB::rollBack();
                $response = ['errors' => $e];
            }
        }

        return redirect()->route('produk.index')->with($response);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'inputedNama' => 'required',
            'inputedHarga' => 'numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $product = Product::find($id);

                $product->nama_produk = strtoupper($request->inputedNama);
                $product->harga = $request->inputedHarga;
                $product->id_kategori = $request->inputedKategori;
                $product->status = strtolower($request->inputedStatus);

                $product->save();

                DB::commit();

                $response = ['success' => 'Data Berhasil Dirubah!'];
            } catch (\Exception $e) {
                DB::rollBack();
                $response = ['errors' => $e];
            }
        }

        return redirect()->route('produk.index')->with($response);
    }

    public function destroy($id)
    {
        try {
            $products = Product::find($id);
            $products->delete();
            $response = ['success' => 'Data Berhasil Dihapus!'];
        } catch (\Exception $e) {
            $response = ['errors' => $e];
        }

        return redirect()->route('produk.index')->with($response);
    }

    public function getData(Request $request)
    {
        // array variable to save list of ids and category for duplication data check
        $arrID = [];
        try {
            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://recruitment.fastprint.co.id/tes/api_tes_programmer");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //enable headers
            curl_setopt($ch, CURLOPT_HEADER, 1);
            //get only headers
            curl_setopt($ch, CURLOPT_NOBODY, 1);
            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);

            $headers = [];
            $output = rtrim($output);
            $data = explode("\n", $output);
            $headers['status'] = $data[0];
            array_shift($data);

            foreach ($data as $part) {

                //some headers will contain ":" character (Location for example), and the part after ":" will be lost
                $middle = explode(":", $part, 2);

                //Supress warning message if $middle[1] does not exist
                if (!isset($middle[1])) {
                    $middle[1] = null;
                }

                $headers[trim($middle[0])] = trim($middle[1]);
            }

            // getting the username value from headers
            $username = substr($headers['X-Credentials-Username'], 0, strpos($headers['X-Credentials-Username'], " ("));

            $post = [
                'username' => $username,
                'password' => md5('bisacoding-' . date('d-m-y')),
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://recruitment.fastprint.co.id/tes/api_tes_programmer");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $response = curl_exec($ch);

            curl_close($ch);

            $data = json_decode($response);

            // saving current data id and category from API into array for a duplication data check
            foreach ($data->data as $row) {
                array_push($arrID, $row->id_produk);
            }

            // saving current list of id from local database into array for duplication data check
            $dbProduct = Product::get();
            foreach ($dbProduct as $row) {
                array_push($arrID, $row->id_produk);
            }

            $category = Category::get();

            foreach ($data->data as $row) {

                // check if there is a new category from API
                $checkCategory = Category::where('nama_kategori', $row->kategori)->get();
                if (empty($checkCategory->first())) {
                    // if there is a new category from API save it into local database
                    Category::create([
                        'nama_kategori' => $row->kategori,
                        'deskripsi_kategori' => strtolower($row->kategori),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    // get the newest data from table category
                    $category = Category::get();
                }

                // check if data from API is the same with data from local database by product id
                $checkProduct = Product::find($row->id_produk);
                if (empty($checkProduct)) {
                    // if data from API doesn't exist in local database then insert that data
                    $product = Product::create([
                        'id_produk' => $row->id_produk,
                        'nama_produk' => $row->nama_produk,
                        'harga' => $row->harga,
                        'id_kategori' => $category->where('nama_kategori', $row->kategori)->first()->id,
                        'status' => $row->status,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    // if there is a same id from API and local database then check if they have a same name
                    // if they have a same name then it is a duplicate data and dont do anything
                    if ($checkProduct->nama_produk != $row->nama_produk) {
                        // if they don't have the same name then change the id from local database using a random number generator
                        // and insert data from API into local database
                        do {
                            $newID = random_int(1, 9999);
                        } while (in_array($newID, $arrID));
                        $checkProduct->update([
                            'id_produk' => $newID,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        $product = Product::create([
                            'id_produk' => $row->id_produk,
                            'nama_produk' => $row->nama_produk,
                            'harga' => $row->harga,
                            'id_kategori' => $category->where('nama_kategori', $row->kategori)->first()->id,
                            'status' => $row->status,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }

            $status = ['success' => 'Pengambilan Data Berhasil!'];
        } catch (\Exception $e) {
            $status = ['errors' => $e];
        }

        return redirect()->route('produk.index')->with($status);
    }
}
