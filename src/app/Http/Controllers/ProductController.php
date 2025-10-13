<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;


class ProductController extends Controller
{
    // 一覧表示
    public function index()
    {
    $products = Product::paginate(6);
    
    return view('product', compact('products'));
    }

    // 検索
    public function search(Request $request)
    {
        $query = Product::query();

        $query = $this->getSearchQuery($request, $query);

        $products = $query->paginate(6);

        return view('product', compact('products'));
    }
    
    // 検索条件
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
        $seasons = Season::all();
        return view('register', compact('seasons')); 
    }

    public function store(ProductRequest $request)
    {
        if ($request->has('back')) {
        return redirect('/products');
    }

        $imagePath = $request->file('image')->store('fruits-img', 'public');

        $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'image' => $imagePath,
        'description' => $request->description,
         ]);
        
        if ($request->has('season')) {
            $product->seasons()->sync($request->season);
        }
        return redirect('/products');
    }

    // 詳細表示
    public function show($id)
    {
        // ID で商品を取得。存在しなければ404
        $product = Product::with('seasons')->findOrFail($id);
        
        $seasons = Season::all(); 
    
        // show.blade に $product を渡す
        return view('show', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        // 画像も更新する場合は処理を追加
    ]);

        $seasons = Season::all();
        return view('show', compact('product', 'seasons'));;
    }



}
