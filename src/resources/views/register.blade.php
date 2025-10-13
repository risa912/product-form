@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">商品登録</h2>
    <div class="register-form__inner">
        <form action="{{ route('products.register') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="register-form__group">
                <label class="register-form__label" for="name">商品名<span class="register-form__required">必須</span></label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
                <p class="register-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="price">値段<span class="register-form__required">必須</span></label>
                <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
                <p class="register-form__error-message">
                    @error('price')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="image">商品画像<span class="register-form__required">必須</span></label>
                <div class="register-form__file">
                    <label class="register-form__file-label" for="image"></label>
                    <div id="image-preview" class="register-form__preview"></div>
                    <input class="register-form__image-input" type="file" name="image" id="image" accept="image/*">
                </div>
                <p class="register-form__error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="season">季節<span class="register-form__required register-form__required--season">必須</span></label>
                <div class="register-form__season-inputs">
                    @foreach ($seasons as $season)
                        <div class="register-form__season-option">
                            <label class="register-form__season-label">
                                <input class="register-form__season-input" 
                                type="checkbox" 
                                name="season[]" 
                                value="{{ $season->id}}"
                                {{ in_array($season->id, old('season', [])) ? 'checked' : '' }}>
                                <span class="register-form__season-text">{{ $season->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <p class="register-form__error-message">
                    @error('season')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="description">商品説明<span class="register-form__required">必須</span></label>
                <textarea class="register-form__textarea" name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <p class="register-form__error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__btn-inner">
                <a href="{{ route('products.index')}}"class="register-form__back-btn btn">戻る</a>
                <input class="register-form__send-btn btn" type="submit" value="登録" name="register">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/product-preview.js') }}"></script>
@endsection