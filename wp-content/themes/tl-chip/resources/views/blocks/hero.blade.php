{{--
  Title: Слайдер
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}



@if (have_rows( 'slider' ))

<section class="hero">
  <div class="hero__slider swiper-container">
    <div class="swiper-wrapper">
    @while (have_rows( 'slider' )) @php  the_row();  @endphp
      <div class="hero__slide swiper-slide">
        @php
          $image  = get_sub_field( 'image' );
          $size   = 'full';
          $title  = get_sub_field( 'title' );
          $text   = get_sub_field( 'text' );
          $button = get_sub_field( 'button' );
        @endphp

        {!! wp_get_attachment_image($image, $size, null,  ['class' => 'hero__image']) !!}

        <div class="hero__container container">
          <div class="hero__content">
          @if ($title)
            <h1 class="hero__title title">{!! $title !!}</h1>
          @endif
          @if (@text)
            <div class="hero__text">
              {!! $text !!}
            </div>
          @endif
          @if ($button)
            <a class="hero__button open-popup button" href="#sign-up-w-discount">{!! $button !!}</a>
          @endif
          </div>
        </div>
      </div>
    @endwhile
    </div>
    <div class="hero__pagination swiper-pagination flex"></div>
  </div>
</section>

@endif