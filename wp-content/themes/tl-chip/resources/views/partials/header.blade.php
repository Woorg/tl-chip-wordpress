@php
  $inst       = get_field( 'instagram', 'option' );
  $vk         = get_field( 'vk', 'option' );
  $youtube    = get_field( 'youtube', 'option' );
  $drive2     = get_field( 'drive2', 'option' );
  $prado_club = get_field( 'prado-club', 'option' );
  $phone      = get_field( 'phone', 'option' );
@endphp

<header class="header">
  <div class="header__container container flex">
    <a class="header__logo logo" href="{{ home_url('/') }}">
      <svg class="logo__icon" width="150px" height="24px">
        <use xlink:href="{{ svg_sprite_paths() }}#logo"></use>
      </svg>
    </a>

    @if (has_nav_menu('menu-1'))
    <nav class="nav header__nav">
      <button class="nav__trigger">
        <svg class="nav__icon_open" width="512px" height="360px">
          <use xlink:href="{{ svg_sprite_paths() }}#menu-icon"></use>
        </svg>

        <svg class="nav__icon_close" width="513px" height="512px">
          <use xlink:href="{{ svg_sprite_paths() }}#menu-close"></use>
        </svg>
      </button>

       {!! wp_nav_menu([
          'theme_location' => 'menu-1',
          'menu_id' => '',
          'container' => '',
          'menu_class' => 'nav__list flex',
          'before' => '',
          'after' => '',
          'link_before' => '<span>',
          'link_after' => '</span>'])
        !!}

    </nav>
    @endif

    <div class="header__contacts flex">
      <ul class="social flex header__social">
        <li class="social__item">
          <a class="social__link" href="{{ $inst }}" target="_blank">
            <svg class="social__icon" width="14" height="14">
              <use xlink:href="{{ svg_sprite_paths() }}#inst-icon"></use>
            </svg>
          </a>
        </li>
        <li class="social__item">
          <a class="social__link" href="{{ $vk }}" target="_blank">
            <svg class="social__icon" width="12" height="12">
              <use xlink:href="{{ svg_sprite_paths() }}#vk-icon"></use>
            </svg>
          </a>
        </li>
        <li class="social__item">
          <a class="social__link" href="{{ $youtube }}" target="_blank">
            <svg class="social__icon" width="14" height="10">
              <use xlink:href="{{ svg_sprite_paths() }}#youtube-icon"></use>
            </svg>
          </a>
        </li>
        <li class="social__item social__item_w_text"><a class="social__link" href="{{ $drive2 }}" target="_blank">DRIVE 2</a>
        </li>
        <li class="social__item social__item_w_text"><a class="social__link" href="{{ $prado_club }}" target="_blank">PRADO-CLUB</a>
        </li>
      </ul>


      <div class="phone flex header__phone">
        <a class="phone__link" href="{{  'tel:+' . str_replace( [
										")",
										"(",
										" ",
										"-",
                    ], "", $phone ) }}">{{ $phone }}</a>
      </div>

    </div>
  </div>
</header>
