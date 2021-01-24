{{--
  Title: Авто
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}


@php
  $title = get_field('title');
@endphp


<div class="catalog">

  <div class="catalog__in container">
    @if ($title)
      <h2 class="catalog__title title title">{{ $title }}</h2>
    @endif
    @php
      $args = [
        'no_found_rows'  => true,
        'post_type'      => 'cars',
        'posts_per_page' => 9,
        'order' => 'DESC',
        'orderby' => 'date'
      ];

      $q = new WP_Query( $args );

    @endphp

    @if ( $q->have_posts() )

    <div class="catalog__list flex">
      @while ( $q->have_posts() ) @php $q->the_post() @endphp
        @php
          $brands        = get_the_terms(get_the_ID(), 'car-brand');
          $feedback_link = get_field( 'feedback_link', get_the_ID() );
        @endphp
      <article class="catalog__card card">
        <div class="card__in">
          <div class="card__image">
            <a class="card__link" href="{{ the_permalink() }}"></a>
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
            @php
              $i = 0;
            @endphp

            <dl class="card__list">

            @while (have_rows( 'tech' , get_the_ID() ))
              @php
                the_row();
                $i++;

              @endphp


            <div class="card__list-item">
                <dt class="card__term">{{ the_sub_field( 'term' ) }}<span>{{ the_sub_field( 'desc' ) }}</span></dt>

              @if (have_rows( 'specs', get_the_ID() ))

                <dd class="card__desc flex">
                @while (have_rows( 'specs', get_the_ID() ))
                  @php
                    the_row();

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
              <svg class="card__price-icon" width="8px" height="12px"><use xlink:href="{{ svg_sprite_paths() }}#price-arrow"></use></svg>
            </a>


          </div>
        </div>
      </article>
      @endwhile

    @endif
    @php wp_reset_postdata(); @endphp


    </div>
  </div>
</div>
