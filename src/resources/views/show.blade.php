@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="detail-form">
    <div class="detail-form__breadcrumb">
        <a class="detail-form__breadcrumb-text" href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
    </div>
    <div class="detail-form__inner">
        <form class="detail" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="detail-form__group detail-form__group--horizontal">
                <div class="detail-form__group">
                    <div class="detail-form__imageBox">
                        <img class="detail-form__image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div id="image-preview" class="register-form__preview"></div>
                        <label class="detail-form__file-label" for="image"></label>
                        <input class="detail-form__image-input" type="file" id="image" name="image" accept="image/*">
                    </div>
                    <p class="detail-form__error-message">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="detail-form__info">
                    <div class="detail-form__group">
                        <label class="detail-form__label" for="name">商品名</label>
                        <input class="detail-form__input" type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                        placeholder="商品名を入力">
                        <p class="detail-form__error-message">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="detail-form__group">
                        <label class="detail-form__label" for="price">値段</label>
                        <input class="detail-form__input" type="text" name="price" id="price"  value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                        <p class="detail-form__error-message">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="detail-form__group">
                        <label class="detail-form__label" for="season">季節</label>
                        <div class="detail-form__season-inputs">
                            
                            @foreach ($seasons as $season)
                                <div class="detail-form__season-option">
                                    <label class="detail-form__season-label">
                                        <input class="detail-form__season-input" 
                                        type="checkbox" 
                                        name="season[]" 
                                        value="{{ $season->name}}"
                                        {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                                        <span class="detail-form__season-text">{{ $season->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <p class="detail-form__error-message">
                            @error('season')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
            </div>

            <div class="detail-form__group">
                <label class="detail-form__label" for="description">商品説明</label>
                <textarea class="detail-form__textarea" type="text" name="description" id="description" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
                <p class="detail-form__error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>
        </form> 

        <div class="detail-form__btn-inner">
            <a href="{{ route('products.index')}}"class="detail-form__back-btn btn">戻る</a>
            <form class="detail-form__save" action="">
                <button class="detail-form__save-btn btn" type="submit" value="変更を保存" name="register">変更を保存</button> 
            </form>
              
            <form class="detail-form__delete-form__delete" action="{{ route('products.destroy', ['productId' => $product->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="detail-form__delete-btn">
                    <img class="detail-form__icon" src="{{ asset('images/trash-icon.png') }}" alt="削除">
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/product-preview.js') }}"></script>
@endsection
