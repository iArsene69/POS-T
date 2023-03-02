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
        // Get the current date in the desired format (e.g. Ymd)
        $date = date('Ymd');

        // Get the latest product code for the current date
        $latestCode = product::where('prodCode', 'like', $date . '%')->latest('id')->first();

        if ($latestCode) {
            // Extract the sequence number from the product code and increment it by 1
            $sequence = intval(substr($latestCode->prodCode, -1)) + 1;
        } else {
            // If no product code exists for the current date, start at 1
            $sequence = 1;
        }

        // Generate the new product code by concatenating the date prefix, a static string ('PRD' in this case), and the sequence number
        $newCode = $date . 'PRD' . $sequence;


        return view('product.index', [
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $validatedP = Validator::make($request->all(), [
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
        } else {
            session()->flash('errors', 'Data Invalid!');
            return redirect()->back();
        }
    }
}