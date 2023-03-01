<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $product = product::all();
        $prodCode = product::latest()->first();
        if ($prodCode) {
            $prodCode = substr($prodCode->prodCode, -1);
            $newCodeNumber = $prodCode + 1;
            $prodCode = '000PRD00' . $newCodeNumber;
        } else {
            $prodCode = '000PRD001';
        }

        return view('product.index', [
            'product' => $product,
            'prodCode' => $prodCode
        ]);
    }

    public function store(Request $request){
        $validatedP = Validator::make($request->all(),[
            'prodCode' => 'required', 
            'nameProd' => 'required',
            'buyPrice' => 'required',
            'sellPrice' => 'required',
            'stock' => 'required',
        ])->validate();

        $createP = product::create($validatedP);

        if ($createP) {
            session()->flash('success', 'Data saved successfully!');
            return redirect()->back();
        }else{
            session()->flash('errors', 'Data Invalid!');
            return redirect()->back();
        }
    }
}
