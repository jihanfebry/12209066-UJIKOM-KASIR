<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    $products = Product::with('orderDetails')->get();

    if ($user->role === 'admin') {
        return view('admin.product.index', compact('products'));
    } elseif ($user->role === 'petugas') {
        return view('petugas.product.index', compact('products'));
    }

    return abort(403, 'Unauthorized');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->merge(['price'=> str_replace(['Rp', '.', ''], '', $request->price)]);

        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
            'product_name'=> 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0'
        ]);

       if($request->hasFile('product_image')){
        $imagePath = $request->file('product_image')->store('product_image', 'public');
       }

       Product::create([
        'product_image' => $imagePath,
        'product_name' => $request->product_name,
        'price' => $request->price,
        'stock' => $request->stock
       ]);

       return redirect()->route('admin.product.index')->with('success', 'Produk Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->merge(['price'=> str_replace(['Rp', '.', ''], '', $request->price)]);

        $request->validate([
            'product_image'=> 'image|mimes:jpg,jpeg,png,gif| max:2048',
            'product_name'=> 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);

        if($request->hasFile('product_image')){
            $imagePath = $request->file('product_image')->store('product_image', 'public');
            $product->product_image = $imagePath;
        }

        $product->product_name = $request->product_name;
        $product->price = str_replace('.', '', $request->price);
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Produk Berhasil diperbarui');
    }

    public function UpdateStock (Request $request, $id){

        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'stock berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->orderDetails()->exists()) {
            return redirect()->back()->with('error', 'Produk tidak dapat dihapus karena sudah pernah dibeli.');
        }
    
        $product -> delete();
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus');
    }
}
