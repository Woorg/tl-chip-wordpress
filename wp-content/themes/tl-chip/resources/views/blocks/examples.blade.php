{{--
  Title: Примеры работ
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
--}}

@php
  $title     = get_field('title');
  $text      = get_field('text');
@endphp


<section class="examples">
  <div class="examples__in container">
    <h2 class="examples__title title">{{ $title }}</h2>
    <div class="examples__text text">
      {!! $text !!}
    </div>

    @php
      $args = [
        'no_found_rows'  => true,
        'post_type'      => 'examples',
        'posts_per_page' => 500,
        'order' => 'ASC',
        'orderby' => 'date'
      ];

      $q = new WP_Query( $args );

    @endphp

    @if ( $q->have_posts() )


    <div class="examples__list flex">
      @while ( $q->have_posts() ) @php $q->the_post() @endphp

        @php
          $brands       = get_the_terms(get_the_ID(), 'car-brand');
          $models       = get_the_terms(get_the_ID(), 'model');
          $gallery_work = get_field( 'gallery', get_the_ID() );
          $feedback     = get_field( 'feedback', get_the_ID() );
        @endphp

      <article class="examples__card card card_w_examples">
        <div class="card__in">
          @if ($gallery_work)
          <div class="card__examples flex">
            @foreach ($gallery_work as $gallery)
            <a class="card__photo" href="{{ wp_get_attachment_image_url($gallery, 'full') }}">
              {!! wp_get_attachment_image($gallery, 'medium') !!}
            </a>
            @endforeach
          </div>
          @endif


          <div class="card__body">
            <div class="card__model flex">
              @foreach( $brands as $brand )
              <svg class="card__logo" width="90px" height="16px">
                <use xlink:href="{{ svg_sprite_paths() }}#{{ $brand->slug }}-logo"></use>
              </svg>
              @endforeach

              @foreach( $models as $model )
              <div class="card__model-name">{{ $model->name }}</div>
              @endforeach
            </div>

            <div class="card__title">{{ the_title() }}</div>

            @if (have_rows( 'tech', get_the_ID() ))
              @php
                $i = 0;
              @endphp
            <dl class="card__list">
              @while (have_rows( 'tech' , get_the_ID() ))
                @php
                  $i++;

                  the_row();

                  // $class = ( $i <= ) ? ' card__list-item card__list-item_n_brake ' : ' card__list-item ';

                @endphp

                @if ($i <= 4)
                <div class="card__list-item card__list-item_n_brake">
                  <dt class="card__term">{{ the_sub_field( 'term' ) }}</dt>
                  <dd class="card__desc">{{ the_sub_field( 'desc' ) }}</dd>
                </div>

                @else
                <div class="card__list-item">
                  <dt class="card__term">{{ the_sub_field( 'term' ) }}<span>{{ the_sub_field( 'desc' ) }}</span></dt>

                @if (have_rows( 'specs', get_the_ID() ))
                  <dd class="card__desc flex">
                  @while (have_rows( 'specs', get_the_ID() ))
                    @php
                      the_row();

                      $from = get_sub_field( 'from' );
                      $to   = get_sub_field( 'to' );

                      // var_dump($ii);

                    @endphp

                    <div class="card__from">{{ $from }}</div>
                    <div class="card__arrow">→</div>
                    <div class="card__to">{{ $to }} л.с</div>

                  @endwhile
                  </dd>
                @endif


                </div>
                @endif


              @endwhile


            </dl>

            @endif

            @if ($feedback)
            <a class="card__price flex" href="{{ $feedback }}">Читать отзыв
              <svg class="card__price-icon" width="8px" height="12px">
                <use xlink:href="{{ svg_sprite_paths() }}#price-arrow"></use>
              </svg>
            </a>
            @endif


          </div>
        </div>
      </article>

      @endwhile

    </div>

    @endif

  </div>
</section>