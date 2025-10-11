@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">商品登録</h2>
    <div class="register-form__inner">
        <form action="/products/register" method="post" enctype="multipart/form-data">
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
                    <label class="register-form__file-label">ファイルを選択</label>
                    <input class="register-form__image-input" type="file" name="image" accept="image/*">
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
                    @foreach(['spring' => '春', 'summer' => '夏', 'autumn' => '秋', 'winter' => '冬'] as $value => $label)
                        <div class="register-form__season-option">
                            <label class="register-form__gender-label">
                                <input class="register-form__season-input" type="radio" name="season" value="{{ $value }}" {{ old('season') === $value ? 'checked' : '' }}>
                                <span class="register-form__season-text">{{ $label }}</span>
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
                <input class="register-form__back-btn btn" type="submit" value="戻る" name="back">
                <input class="register-form__send-btn btn" type="submit" value="登録" name="register">
            </div>
        </form>
    </div>
</div>
@endsection