@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css')}}" />
@endsection

@section('content')
    <aside class="search-form__inner">
        <form class="search" action="{{ route('products.search') }}"method="get">
            <h2 class="search-form__heading content__heading">
                @if(request('keyword') && !request('sort'))
                    "{{ request('keyword') }}"の商品一覧
                @else
                    商品一覧
                @endif
            </h2>
            <input class="search-form__input"
                   type="text"
                   name="keyword"
                   placeholder="商品名で検索"
                   value="{{ request('keyword') }}">
            <button class="search-form__btn btn">検索</button>

            <div class="search-form__select-inner">
                <label class="search-form__label">価格順で表示</label>
                <select class="search-form__select" name="sort">
                    <option value="" disabled selected>価格で並べ替え</option>
                    <option class="search-form__option search-form__option--price" value="asc" @if(request('sort') === 'asc') selected @endif>安い順</option>
                    <option class="search-form__option search-form__option--price" value="desc" @if(request('sort') === 'desc') selected @endif>高い順</option>
                </select>
            </div>

            @if(request('sort'))
            <div class="tag">
                <p class="tag__text">
                    @if(request('sort') === 'asc')
                        安い順で表示
                    @elseif(request('sort') === 'desc')
                        高い順で表示
                    @endif
                </p>
                <a href="{{ url('/products?' . http_build_query(request()->except('sort'))) }}" class="tag-btn">×</a>
            </div>
            @endif
        </form>
    </aside>

    <main class="product">
        <div class="product-area">
            <a href="/products/register" class="product-area__btn btn">
                <span>+</span>商品を追加
            </a>
        </div>

        <div class="product-list">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-list__card">
                     <img class="product-list__img" src="{{ Storage::url(  $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-list__textBox">
                        <p class="product-list__text">{{ $product->name }}</p>
                        <p class="product-list__text">¥{{ number_format($product->price) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->appends(request()->query())->links() }} 
        </div>
    </main>
@endsection