{{--
  Title: Гарантийные обязательства
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
  SupportsInnerBlocks: true
--}}

@php
  $title = get_field( 'title' );
  $text = get_field( 'text' );

@endphp

<section class="warranty">
  <div class="warranty__in container">
    <h1 class="warranty__title title">{!! $title !!}</h1>
    <div class="warranty__text text">
      {!! $text !!}
    </div>

    @if ( have_rows( 'list' ) )
      @php
        $i = 0;
      @endphp
    <ul class="warranty__liabilities flex">
      @while (have_rows( 'list' ))
        @php

          $i++;

          the_row();

          $title = get_sub_field( 'title' );
          $text  = get_sub_field( 'text' );

        @endphp
      <li class="warranty__liabilities-item">
        <div class="warranty__liabilities-in flex">
          <div class="warranty__liabilities-image">
            <svg class="warranty__liabilities-icon" width="32px" height="31px">
              <use xlink:href="{{ svg_sprite_paths() }}#warranty-icon-{{ $i }}"></use>
            </svg>
          </div>
          <div class="warranty__liabilities-entry">
            <div class="warranty__liabilities-title">{{ $title }}</div>
            <div class="warranty__liabilities-text">{{ $text }}</div>
          </div>
        </div>
      </li>
      @endwhile

    </ul>
    @endif
  </div>
</section>