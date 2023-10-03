<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $product = Product::all();
        $data = [
            'products' => $product
        ];
        return view('product.index')->with('data', $data);
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'description' => $request->description,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'created_by' => 10
        ]);

        if($product){
            return redirect()->back()->with('success_message', 'Data product berhasil ditambahkan!');
        }else{
            return redirect()->back()->with('error_message', 'Data product gagal ditambahkan!');
        }
    }

    public function getProduct(Request $request)
    {
        $data = Product::findOrFail($request->id);
        return response()->json($data);
    }

    public function updateProduct(Request $request)
    {
        $productUpdate = Product::where('id', $request->id_edit)->update([
            'description' => $request->description_edit,
            'type' => $request->type_edit,
            'quantity' => $request->quantity_edit,
            'price' => $request->price_edit,
            'updated_by' => 10
        ]);

        if($productUpdate){
            return redirect()->back()->with('success_message', 'Data product berhasil diupdate!');
        }else{
            return redirect()->back()->with('error_message', 'Data product gagal diupdate!');
        }
    }

    public function deleteProduct(Request $request)
    {
        $productDelete = Product::where('id', $request->id_delete)->delete();

        if($productDelete){
            return redirect()->back()->with('success_message', 'Data product berhasil dihapus!');
        }else{
            return redirect()->back()->with('error_message', 'Data product gagal dihapus!');
        }
    }
}
