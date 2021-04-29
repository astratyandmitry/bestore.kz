@php /** @var \Domain\Shop\Models\Ambassador[]|\Illuminate\Database\Eloquent\Collection $ambassadors */ @endphp

@if ($slides->isNotEmpty())
    <div class="ambassadors">
        <div class="heading heading--spaced">
            <div class="container">
                @include('shop::layouts.partials.heading.title', ['title' => 'Нас выбирают <span>лучшие</span>'])
            </div>
        </div>

        <div class="container">
            <div class="ambassadors__grid">
                @foreach($ambassadors as $ambassador)
                    <div class="ambassador">
                        <div class="ambassador__name">
                            {{ $ambassador->name }}
                        </div>

                        <div class="ambassador__link">
                            <a href="https://instagram.com/{{ $ambassador->instagram_username }}" target="_blank">
                                &commat;{{ $ambassador->instagram_username }}
                            </a>
                        </div>


                        <div class="ambassador__media">
                            <img src="{{ $ambassador->photo }}" alt="{{ $ambassador->name }}" class="ambassador__image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
