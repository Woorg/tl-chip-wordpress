@php
  $top_bg    = get_field('top_bg');
  $feedbacks = get_field( 'feedbacks' );
  $videos    = get_field( 'videos' );
@endphp

<section class="car">
  <div class="car__top-w">
    <div class="car__top">
      {!! wp_get_attachment_image( $top_bg, 'full' ) !!}
    </div>
    <div class="car__in container flex">
      {!! kama_previous_posts_from_tax([
        'post_num'  => 1,
        'format'    => '{a}{title}{/a}',
        'tax'       => 'car-brand',
        'post_type'  => 'cars'])

      !!}
      <h1 class="car__title title">{{ the_title() }}</h1>

    </div>
  </div>
  <section class="benefits car__benefits">
    <div class="benefits__in container">
      <h2 class="benefits__title title">Преимущества и цены</h2>

      {{-- show related cars --}}

      @if (get_field( 'show_related' ) == 1)

        @php
          // $args = [
          //   'no_found_rows'  => true,
          //   'post_type'      => 'cars',
          //   'posts_per_page' => 2,
          //   'order'          => 'ASC',
          //   'orderby'        => 'rand'
          // ];

          // $q = new WP_Query( $args );
          $other_variants = get_field('other_variants');
        @endphp

        {{-- @if ( $q->have_posts() ) --}}
        @if ($other_variants)

          <div class="benefits__grid flex">

          {{-- @while ($q->have_posts()) @php $q->the_post(); @endphp --}}
          @foreach ($other_variants as $post)

            @php
              setup_postdata( $post );
              $brands        = get_the_terms(get_the_ID(), 'car-brand');
              $feedback_link = get_field( 'feedback_link' );
            @endphp

              <article class="benefits__card card">
                <div class="card__in">
                  <div class="card__image">
                    <a class="card__link" href="{!! get_the_permalink($post->ID) !!}"></a>
                    {!! get_the_post_thumbnail($post->ID, 'medium') !!}

                    @if ($feedback_link)
                      <a class="card__feedback" href="{{ $feedback_link }}">Отзыв клиента</a>
                    @endif

                  </div>
                  <div class="card__body">
                    <div class="card__model flex">
                      @foreach( $brands as $brand )
                      <svg class="card__logo" width="90px" height="16px">
                        <use xlink:href="{{ svg_sprite_paths() }}#{{ $brand->slug }}-logo"></use>
                      </svg>
                      @endforeach

                      <div class="card__model-name">{!! get_the_title($post->ID) !!}</div>
                   </div>


                    @if (have_rows( 'tech', get_the_ID() ))
                      @php
                      @endphp

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
                              <div class="card__to">{{ $to }} л.с</div>
                            @endwhile
                          </dd>
                        @endif

                        </div>

                      @endwhile

                      </dl>

                    @endif

                    <a class="card__price flex" href="{{ get_the_permalink($post->ID) }}">Цены и графики
                      <svg class="card__price-icon" width="8px" height="12px">
                        <use xlink:href="{{ svg_sprite_paths() }}#price-arrow"></use>
                      </svg>
                    </a>

                  </div>
                </div>
              </article>
          @endforeach

          @php
             wp_reset_postdata();
          @endphp

          {{-- @endwhile --}}

          </div>

        @endif

      @endif

      @if (have_rows( 'benefits' ))

        <ul class="benefits__prices">

        @while (have_rows( 'benefits' )) @php the_row(); @endphp

          <li class="benefits__prices-item">{{  the_sub_field( 'item' ) }}</li>

        @endwhile

        </ul>

      @endif

      <div class="benefits__links flex">
        @if ($feedbacks)
          <a class="benefits__link" href="{{ $feedbacks }}">Читать отзывы автовладельцев
            <svg class="benefits__link-icon" width="22px" height="14px"><use xlink:href="{{ svg_sprite_paths() }}#video-arrow"></use></svg>
          </a>
        @endif

        @if ($videos)
          <a class="benefits__link" href="{{ $videos }}">Видео-замер разгона до и после чип тюнинга
            <svg class="benefits__link-icon" width="22px" height="14px"><use xlink:href="{{ svg_sprite_paths() }}#video-arrow"></use></svg>
          </a>
        @endif

      </div>
    </div>
  </section>

  {{ the_content() }}

{{--   <div class="chart car__chart">
    <div class="chart__in container">
      <h2 class="chart__title title">График замера мощности</h2>
      <div class="chart__charts">
        <div class="chart__chart">
          <div class="chart__chart-in">
            <div class="chart__chart-title">Land Cruiser 200, 4.5D (после 2016 г.в.)</div>
            <div class="chart__object">
              <img src="assets/images/content/chart-img-1.png" alt="">
            </div>
          </div>
        </div>
        <div class="chart__chart">
          <div class="chart__chart-in">
            <div class="chart__chart-title">Land Cruiser 200, 4.5D (до 2016 г.в.)</div>
            <div class="chart__object">
              <img class="lazy" data-src="assets/images/content/chart-img-1.png" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="chart__text text">
        <p>TOYOTA LAND CRUISER 200 с дизельным двигателем, поставляемая на российский рынок с дефорсированным (сниженная мощность) двигателем 235 л.с., имеет родную мощность на европейском рынке практически 300 л.с.</p>
        <p>Вывод — мощность, полученная в результате чип тюнинга ECU TOYOTA, заранее заложена производителем TOYOTA MOTOR RUS во все дизельные двигатели.</p>
      </div>
    </div>
  </div>
</section> --}}
