<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Memanggil ProductModel
use App\Models\ProductModel;

class ThumbnailController extends Controller
{
    public function product()
    {
    	// mengambil data dari table pegawai
    	$product = DB::table('product')->get();
 
    	// mengirim data pegawai ke view index
    	return view('dashboard',['product' => $product]);
 
    }
}
