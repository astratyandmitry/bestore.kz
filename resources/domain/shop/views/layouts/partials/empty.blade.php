@php /** @var string $title */ @endphp
@php /** @var string $about */ @endphp

<div class="empty">
  <div class="empty__title">
    {{ $title }}
  </div>

  <div class="empty__message">
    {{ $about }}
  </div>

  <div class="empty__action">
    <a href="{{ route('shop::categories') }}" class="form-button empty__button">
      Перейти в каталог
    </a>
  </div>
</div>
