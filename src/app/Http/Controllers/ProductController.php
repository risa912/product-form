<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

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

        if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('price', $request->sort);
        }

        return $query;
    }

    // 作成フォーム表示
    public function create()
    {
        $seasons = Season::all();
        return view('register', compact('seasons')); 
    }

    // 新規登録
    public function store(ProductRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('products.index');
        }

        $imagePath = $request->file('image')->store('fruits-img', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        if ($request->filled('season')) {  
            $seasonIds = array_map('intval', $request->season);
            $seasonIds = array_filter($seasonIds, fn($id) => $id > 0);

            if (!empty($seasonIds)) {
                $product->seasons()->sync($seasonIds);
            }
        }

        return redirect()->route('products.index');
    }

    // 詳細表示
    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all(); 

        return view('show', compact('product', 'seasons'));
    }

    // 更新
    public function update(UpdateProductRequest $request, $productId)
    {

        $product = Product::findOrFail($productId);
        $image = $request->file('image');
        $path = $product->image; 

        if (isset($image)) {
            Storage::disk('public')->delete($path);
            $path = $image->store('fruits-img', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        if ($request->filled('season')) {
            $seasonIds = Season::whereIn('name', $request->season)->pluck('id')->toArray();
            $product->seasons()->sync($seasonIds);
        } else {
            $product->seasons()->sync([]);
        }

        return redirect()->route('products.index');
    }

    // 削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index');
    }
}
