<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Memanggil ProductModel
use App\Models\ProductModel;

class ProductController extends Controller
{

    public function product()
    {
    	// mengambil data dari table pegawai
    	$product = DB::table('product')->get();
 
    	// mengirim data pegawai ke view index
    	return view('dashboard',['product' => $product]);
 
    }

    public function tampildata()
    {
    	// mengambil data dari table pegawai
    	$product = DB::table('product')->get();
 
    	// mengirim data pegawai ke view index
    	return view('admin',['product' => $product]);
 
    }

	public function tambahdata(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required|unique:guru',
            'category_id' =>'required',
            'description' => 'required',
            'price' => 'required',
            'pict'=> 'required',
        ]);
        
        $file_name = $request->image->getClientOriginalName();
        $pict = $request->image->storeAs('pict', $file_name);

        ProductModel::create([
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'pict' => $pict
        ]);

        return redirect('/admin')->with('messagetambah', 'Data Tersimpan');
    }

    public function destroy($product_id)
    {
        $delete=ProductModel::find($product_id);
        $delete->delete();

        return redirect()->back()->with('messagehapus', 'Data Dihapus');
    }


    public function editdata($product_id, Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required|unique:guru',
            'category_id' =>'required',
            'description' => 'required',
            'price' => 'required',
            'pict'=> 'required',
        ]);

        $edit = ProductModel::find($product_id);
        $edit->product_id       = $request->input('product_id');
        $edit->product_name     = $request->input('product_name');
        $edit->category_id      = $request->input('category_id');
        $edit->description      = $request->input('description');
        $edit->price            = $request->input('price');

        $edit->save();

        //return redirect('/jurursan');
        return redirect()->back()->with('messageedit', 'Data Disunting');
    }
}
