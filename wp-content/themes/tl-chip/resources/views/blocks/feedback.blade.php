{{--
  Title: Отзывы
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}


@php

  $title            = get_field('title');
  $is_separate_page = get_field( 'full' );
  $is_white_theme   = get_field('light_theme');

  $fullClass        = ( get_field( 'full' ) == 1 ) ? ' feedback feedback_full ' : ' feedback ';
  $class_white      = ( get_field( 'light_theme' ) == 1 ) ? ' feedback feedback_full feedback_t_white ' : ' feedback ';

  $text             = get_field( 'text' );

  $attention_title  = get_field( 'attention_title' );
  $attention_text   = get_field( 'attention_text' );
  $text_2           = get_field( 'text_2' );

@endphp

@if ($is_separate_page && !$is_white_theme)
<section class="{{ $fullClass }}">
@endif
@if ($is_white_theme)
<section class="{{ $class_white }}">
@endif
@if (!$is_separate_page)
<section class="feedback">
@endif


  <div class="feedback__in container">
    @if ($title)
      <h2 class="feedback__title title">{{ $title }}</h2>
    @endif

    @if ($text)
    <div class="feedback__text text">
      {!! $text !!}
    </div>
    @endif

    @if ($attention_title)
    <div class="feedback__attention">
      <div class="feedback__attention-title">{{ $attention_title }}</div>
      <div class="feedback__attention-text">{{ $attention_text }}</div>
    </div>
    @endif

    @if ($text_2)
    <div class="feedback__text text">
      {!! $text_2 !!}
    </div>
    @endif


    @if (!$is_separate_page)
    <svg class="feedback__bg" width="176px" height="149px">
      <use xlink:href="{{ svg_sprite_paths() }}#quote-icon"></use>
    </svg>
    @endif

    @if (!$is_white_theme)

    <div class="feedback__slider swiper-container">
      <div class="feedback__slider-wrapper swiper-wrapper">

    @php
      $args = [
        'no_found_rows'  => true,
        'post_type'      => 'feedbacks',
        'cat'            => 22,
        'posts_per_page' => 500,
        'order' => 'ASC',
        'orderby' => 'date'
      ];

      $q = new WP_Query( $args );

    @endphp

    @if ( $q->have_posts() )
      @while ($q->have_posts()) @php $q->the_post() @endphp
        @php
          $link = get_field('link', get_the_ID());
          $name = get_field('name', get_the_ID());
          $auto = get_field('auto', get_the_ID());

        @endphp
        <div class="feedback__slide swiper-slide">
          <div class="feedback__slide-in">
            <div class="feedback__body">
              <div class="feedback__body-title">{{ the_title() }}</div>
              <div class="feedback__body-text">{{ the_content() }}</div>

              @if ($link)
                <a class="feedback__link flex" href="{{ $link }}">Читать далее
                  <svg class="feedback__icon" width="12px" height="12px">
                      <use xlink:href="{{ svg_sprite_paths() }}#vk-icon"></use>
                  </svg>
                </a>
              @endif

            </div>
            <div class="feedback__author-w flex">
              <div class="feedback__author flex">
                <div class="feedback__avatar">
                  {!! get_the_post_thumbnail(get_the_ID(), 'thumb', ['class'=> 'feedback__avatar-img']) !!}
                </div>
                <div class="feedback__author-content">
                  <div class="feedback__author-name">{{ $name }}</div>
                  <div class="feedback__author-model">{{ $auto }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>

      @endwhile
    @endif

    @php
      wp_reset_postdata()
    @endphp

      </div>
      <div class="feedback__pagination swiper-pagination flex"></div>
    </div>

    @endif
    {{-- ! white theme --}}

  @if ($is_white_theme )

    @php
      $args = [
        'no_found_rows'  => true,
        'post_type'      => 'feedbacks',
        'cat'            => 23,
        'posts_per_page' => 500,
        'order' => 'ASC',
        'orderby' => 'date'
      ];

      $q = new WP_Query( $args );

    @endphp

    @if ( $q->have_posts() )
      @while ($q->have_posts()) @php $q->the_post() @endphp
        @php
          $link = get_field('link', get_the_ID());
        @endphp
      <div class="feedback__forum-list">

        <article class="feedback__forum-item">
          <div class="feedback__forum-in">
            <div class="feedback__forum-top flex">
              <div class="feedback__forum-model">{{ the_title() }}</div><a class="feedback__forum-link" href="{{ $link }}" target="_blank">Читать отзыв</a>
            </div>
            <a class="feedback__image" href="{{ the_post_thumbnail_url('full') }}">
              {{ the_post_thumbnail('full') }}
            </a>
          </div>
        </article>

      </div>

      @endwhile
    @endif

    @php
      wp_reset_postdata()
    @endphp

  @endif

  </div>
</section>