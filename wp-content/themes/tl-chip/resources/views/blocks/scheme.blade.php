{{--
  Title: График замера мощности
  Category: common
  Mode: auto
  Align: full
  PostTypes: cars
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
  SupportsInnerBlocks: true
--}}


@php
  $title = get_field('title');
  $text  = get_field('text');
  $video = get_field( 'video' );
@endphp

<div class="chart car__chart">
  <div class="chart__in container">
    @if ($title)
      <h2 class="chart__title title">{{ $title }}</h2>
    @endif

    @if (have_rows( 'charts' ))
      <div class="chart__charts">
      @while (have_rows( 'charts' )) @php the_row(); @endphp
        @php
          $schema_title = get_sub_field( 'schema_title' );
          $schema_img   = get_sub_field( 'schema_img' );
        @endphp
        <div class="chart__chart">
          <div class="chart__chart-in">
            @if ($schema_title)
              <div class="chart__chart-title">{{ $schema_title }}</div>
            @endif
            @if ($schema_img)
              <div class="chart__object">
                {!! wp_get_attachment_image($schema_img, 'full') !!}
              </div>
            @endif
          </div>
        </div>
      @endwhile
      </div>
    @endif

    @if ($text)
      <div class="chart__text text">
        {!! $text !!}
      </div>
    @endif

    @if ($video)
      <div class="chart__videos">
        <div class="chart__video">
          <div class="chart__video-object">
            {!! $video !!}
          </div>
        </div>
      </div>
    @endif

  </div>
</div>
