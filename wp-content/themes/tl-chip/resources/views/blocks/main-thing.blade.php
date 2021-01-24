{{--
  Title: Что главное в чип тюнинге
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: false
  SupportsMultiple: false
--}}


@php
  $title     = get_field( 'title' );
  $text      = get_field( 'text' );
  $imp_title = get_field( 'important_title' );
  $imp_text  = get_field( 'important_text' );

@endphp

<section class="main-thing">
  <div class="main-thing__in container">
    <h2 class="main-thing__title title">{!! $title !!}</h2>

    <div class="main-thing__text text">{!! $text !!}</div>
    @if (have_rows( 'list' ))
    <dl class="main-thing__list">
      @while (have_rows( 'list' ))
        @php
          the_row();

          $title = get_sub_field( 'title' );
          $text = get_sub_field( 'text' );


        @endphp
        @if ($title)
        <dt class="main-thing__term">{{ $title }}</dt>
        @endif

        @if ($text)
        <dd class="main-thing__desc">{!! $text !!}</dd>
        @endif
      @endwhile
    </dl>
    @endif

    <div class="main-thing__important">
      <div class="main-thing__important-in">
        <div class="main-thing__important-title">{{ $imp_title }}</div>
        <div class="main-thing__important-text">{{ $imp_text }}</div>
      </div>
    </div>

  </div>
</section>