{{--
  Title: Видео
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}

@php

  $title  = get_field( 'title' );
	$text   = get_field( 'text' );
	$link   = get_field( 'link' );
	$iframe = get_field( 'iframe' );

@endphp

<section class="video">
  <div class="video__in container">
    <div class="video__row flex">
      <div class="video__col">
        <div class="video__content">
        @if ($title)
          <h2 class="video__title title title_big">{{ $title }}</h2>
        @endif
        @if ($text)
          <div class="video__text">{{ $text }}</div>
        @endif
        @if ($link)
          <a class="video__more" href="{{ $link }}" target="_blank">Смотреть <svg class="video__more-icon" width="22px" height="14px"><use xlink:href="{{ svg_sprite_paths() }}#video-arrow"></use></svg>
          </a>
        @endif
        </div>
      </div>

      <div class="video__col ">
        <div class="video__object-w">
          @if ($iframe)
            {!! $iframe !!}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
