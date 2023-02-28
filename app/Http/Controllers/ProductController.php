<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = product::all();
        $prodCode = product::latest()->first();
        if ($prodCode) {
            $prodCode = substr($prodCode->prodCode, -1);
            $newCodeNumber = $prodCode + 1;
            $prodCode = '000PRD' . $newCodeNumber;
        } else {
            $prodCode = '000PRD001';
        }

        return view('product.index', [
            'product' => $product,
            'prodCode' => $prodCode
        ]);
    }

    public function store(Request $request){
        $createP = product::create([
            'prodCode' => $request->prodCode,
            'nameProd' => $request->nameProd,
            'buyPrice' => $request->buyPrice,
            'sellPrice' => $request->sellPrice,
            'stock' => $request->stock
        ]);

        return redirect()->route('product.index');
    }
}
