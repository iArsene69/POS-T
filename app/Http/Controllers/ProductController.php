<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::all();

        return view('product.index', [
            'product' => $product,
        ]);
    }

    public function checkProduct(Request $request, $prodCode)
    {
        $product = product::where('prodCode', $prodCode)->first();
        if ($product) {
            $data = [
                'exists' => true,
                'nameProd' => $product->nameProd,
                'buyPrice' => $product->buyPrice,
                'sellPrice' => $product->sellPrice
            ];
        } else {
            $data = [
                'exists' => false
            ];
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $product = product::where('prodCode', $request->prodCode)->first();
        if ($product) {
          $createP =  $product->update([
                'prodCode' => $request->prodCode,
                'nameProd' => $request->nameProd,
                'buyPrice' => $request->buyPrice,
                'sellPrice' => $request->sellPrice,
                'stock' => $product->stock + $request->stock
          ]);
        } else {
            $createP = product::create([
                'prodCode' => $request->prodCode,
                'nameProd' => $request->nameProd,
                'buyPrice' => $request->buyPrice,
                'sellPrice' => $request->sellPrice,
                'stock' => $request->stock
            ]);
        }

        if ($createP) {
            session()->flash('success', 'Data saved successfully!');
            return redirect()->back();
        } else {
            session()->flash('errors', 'Data Invalid!');
            return redirect()->back();
        }
    }
}