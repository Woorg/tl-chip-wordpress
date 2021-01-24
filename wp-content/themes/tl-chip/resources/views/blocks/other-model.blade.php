{{--
  Title: Другая модель
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}


@php
  $title = get_field( 'title' );
  $text  = get_field( 'text' );
  $link  = get_field( 'link' );
  $image = get_field( 'image' );
@endphp


<section class="other-model">
  <div class="other-model__in container flex">
    <div class="other-model__content">

      @if ($title)
      <h2 class="other-model__title title">{{ $title }}</h2>
      @endif

      @if ($text)
      <div class="other-model__text">{!! $text !!}
      </div>
      @endif

      @if ($link)
      <a class="other-model__link" href="{{ $link }}">Смотреть
        <svg class="other-model__icon" width="22px" height="14px">
            <use xlink:href="{{ svg_sprite_paths() }}#video-arrow"></use>
        </svg>
      </a>
      @endif

    </div>

    @if ($image)
      {!! wp_get_attachment_image( $image, 'full', null, ['class' => 'other-model__image'] ) !!}
    @endif

  </div>
</section>