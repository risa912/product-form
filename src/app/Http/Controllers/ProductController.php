<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product; 


class ProductController extends Controller
{

    public function index()
    {
    $products = Product::paginate(6);
    
    
    return view('products', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(7);

        return view('products', compact('products'));
    }
    
    private function getSearchQuery(Request $request, $query)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('name', 'like', "%{$keyword}%");
        }

        if ($request->filled('sort') && in_array($request->sort, ['asc','desc'])) {
            $query->orderBy('price', $request->sort);
        }

        return $query;
    }

    public function create()
    {

    return view('register'); 
    }

    public function store(ProductRequest $request)
    {
        if ($request->has('back')) {
        return redirect('/products')->withInput();
        }

        $imagePath = $request->file('image')->store('fruits-img', 'public');

         $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $imagePath,
        'description' => $request->description,
         ]);

        if ($request->filled('season_ids')) {
        $product->seasons()->sync($request->season_ids);
        }

        // 商品一覧へリダイレクト（メッセージなし）
        return redirect('/products');
    }
}
