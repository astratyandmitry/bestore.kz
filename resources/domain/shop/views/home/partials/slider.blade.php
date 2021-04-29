@php /** @var \Domain\Shop\Models\Slide[]|\Illuminate\Database\Eloquent\Collection $slides */ @endphp

@if ($slides->isNotEmpty())
    <div class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                    <div class="swiper-slide slide">
                        <div class="slide__image" style="background-image: url({{ $slide->image }})"></div>
                        <div class="slide__shadow"></div>
                        <div class="container">
                            <div class="slide__body">
                                <div class="slide__title">
                                    {{ $slide->title }}
                                </div>

                                <div class="slide__about">
                                    {{ $slide->about }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var mySwiper = new Swiper('.swiper-container', {
                direction: 'horizontal',
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
            })
        </script>
    @endpush
@endif
