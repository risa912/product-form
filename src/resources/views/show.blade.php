@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="detail-form">
    <div class="detail-form__breadcrumb">
        <a class="detail-form__breadcrumb-text" href="{{ url('/products') }}">商品一覧</a> > {{ $product->name }}
    </div>
    <div class="detail-form__inner">
        <form class="register" action="" method="">
            <div class="detail-form__group detail-form__group--horizontal">
                <div class="detail-form__group">
                    <label class="detail-form__label" for="image"></label>
                        <div class="detail-form__season-option">
                            <img class="detail-form__image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <label class="detail-form__file-label">ファイルを選択</label>
                            <input class="detail-form__image-input" type="file" name="image" accept="image/*">
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
            <div class="detail-form__btn-inner">
                 <a href="{{ url('/products') }}" class="detail-form__back-btn btn">戻る</a>
                <input class="detail-form__send-btn btn" type="submit" value="変更を保存" name="register">
            </div>
        </form>    
    </div>
</div>
@endsection
