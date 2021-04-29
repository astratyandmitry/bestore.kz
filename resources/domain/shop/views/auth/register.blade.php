@extends('shop::layouts.master')

@section('content')
  <div class="auth">
    <div class="container container--sm">
      <div class="auth__form">
        <h1 class="auth__title">
          {{ $layout->title }}
        </h1>

        <form method="post" class="auth__content">
          @csrf

          @include('shop::layouts.includes.form.field.input', [
              'attribute' => 'email',
              'placeholder' => 'E-mail',
              'type' => 'email',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password',
              'placeholder' => 'Пароль',
              'required' => true,
          ])

          @include('shop::layouts.includes.form.field.password', [
              'attribute' => 'password_confirmation',
              'placeholder' => 'Подтверждение пароля',
              'required' => true,
          ])

          <button type="submit" class="form-button form-button--full">
            Зарегистрироваться
          </button>
        </form>
      </div>

      <div class="auth__action">
        <a href="{{ route('shop::auth.login') }}">
          У меня уже есть аккаунт
        </a>
      </div>
    </div>
  </div>
@endsection
