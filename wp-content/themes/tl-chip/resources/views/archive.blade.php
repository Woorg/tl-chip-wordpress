@extends('layouts.app-inner-v2')

@section('content')
  <section class="catalog catalog_w_filter">
    <div class="catalog__in container">

      <div class="catalog__top flex">
        <h1 class="catalog__title title ">Каталог</h1>
        <div class="filter catalog__filter  flex">
          <div class="filter__field filter__field_1">
            {!! do_shortcode( '[facetwp facet="car_brand"]' ) !!}
          </div>
          <div class="filter__field filter__field_2">
            {!! do_shortcode( '[facetwp facet="model"]' ) !!}
          </div>
          <div class="filter__field filter__field_3">
            {!! do_shortcode( '[facetwp facet="capacity"]' ) !!}
          </div>
        </div>
      </div>

      <div class="catalog__list facetwp-template flex">
        @while(have_posts()) @php the_post() @endphp
          @php
            $brands        = get_the_terms(get_the_ID(), 'car-brand');
            $feedback_link = get_field('feedback_link');
          @endphp

          <article class="catalog__card card">
            <div class="card__in">
              <div class="card__image">
                <a href="{{ the_permalink() }}" class="card__link"></a>
                {{ the_post_thumbnail() }}

                <a class="card__feedback" href="{{ $feedback_link }}">Отзыв клиента</a>
              </div>

              <div class="card__body">
                <div class="card__model flex">
                  @foreach( $brands as $brand )
                    <svg class="card__logo" width="90px" height="16px">
                      <use xlink:href="{{ svg_sprite_paths() }}#{{ $brand->slug }}-logo"></use>
                    </svg>
                  @endforeach
                  <div class="card__model-name">{{ the_title() }}</div>
                </div>

                @if (have_rows( 'tech', get_the_ID() ))

                  <dl class="card__list">

                    @while (have_rows( 'tech' , get_the_ID() )) @php the_row(); @endphp

                      <div class="card__list-item">
                        <dt class="card__term">{{ the_sub_field( 'term' ) }}<span>{{ the_sub_field( 'desc' ) }}</span></dt>

                        @if (have_rows( 'specs', get_the_ID() ))
                          <dd class="card__desc flex">
                            @while (have_rows( 'specs', get_the_ID() )) @php the_row(); @endphp
                              @php
                                $from = get_sub_field( 'from' );
                                $to   = get_sub_field( 'to' );
                              @endphp

                              <div class="card__from">{{ $from }}</div>
                              <div class="card__arrow">→</div>
                              <div class="card__to">{{ $to }}</div>
                            @endwhile
                          </dd>
                        @endif


                      </div>

                    @endwhile

                  </dl>

                @endif

                <a class="card__price flex" href="{{ the_permalink() }}">Цены и графики
                  <svg class="card__price-icon" width="8px" height="12px">
                    <use xlink:href="{{ svg_sprite_paths() }}#price-arrow"></use>
                  </svg>
                </a>

              </div>

            </div>
          </article>
        @endwhile


      </div>
      <div class="catalog__load-w flex">
        {!! do_shortcode( '[facetwp facet="load_more"]' ) !!}
        {{-- <button class="catalog__load-more fwp-load-more button">Загрузить еще</button> --}}
      </div>

    </div>
  </section>

@php

  $trust_title = get_field( 'trust_title', 'options' );
@endphp

  <section class="trusted">
    <div class="trusted__in container">
      @if ($trust_title)
        <h2 class="trusted__title title">Отзывы с drive2.ru</h2>
      @endif

      @if ( have_rows( 'trust_list', 'option' ) )
        <div class="trusted__grid flex">
          @while (have_rows( 'trust_list', 'option' )) @php the_row(); @endphp
            @php
              $trust_image = get_sub_field( 'trust_image' );
            @endphp
            <article class="trusted__item">
              <div class="trusted__item-in">
                <a class="trusted__object" href="{{ wp_get_attachment_image_url( $trust_image, 'full' )}}">
                    {!! wp_get_attachment_image($trust_image, 'medium') !!}
                </a>
              </div>
            </article>
          @endwhile
        </div>
      @endif
    </div>
  </section>
@endsection

