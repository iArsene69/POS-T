<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $product = product::query();

        if ($keyword) {
            $product = $product->where('prodCode', 'like', "%{$keyword}%")
                ->orWhere('nameProd', 'like', "%{$keyword}%");
        }

        $product = $product->paginate(5);

        return view('product.index', compact('product'));
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

        $validatedP = Validator::make($request->all(), [
            'prodCode' => 'required',
            'nameProd' => 'required',
            'buyPrice' => 'required',
            'sellPrice' => 'required',
            'stock' => 'required'
        ]);

        if ($product) {
            $createP = $product->update([
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

    public function update(Request $request)
    {
        $product = product::where('prodCode', $request->prodCode)->first();

        $validatedP = Validator::make($request->all(), [
            'nameProd' => 'required',
            'buyPrice' => 'required',
            'sellPrice' => 'required',
            'stock' => 'required'
        ]);

        if ($product) {
            $updateP = $product->update([
                'nameProd' => $request->nameProd,
                'buyPrice' => $request->buyPrice,
                'sellPrice' => $request->sellPrice,
                'stock' => $request->stock
            ]);
        }

        if ($updateP) {
            session()->flash('success', 'Data updated successfully!');
            return redirect()->back();
        } else {
            session()->flash('errors', 'Data Invalid!');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $product = product::where('id', $id)->first();

        if ($product) {
            $deleteP = $product->delete();
        }

        if ($deleteP) {
            session()->flash('success', 'Data successfully deleted!');
            return redirect()->back();
        } else {
            session()->flash('errors', 'Data Invalid!');
            return redirect()->back();
        }

    }
}