@php
  $inst       = get_field( 'instagram', 'option' );
  $vk         = get_field( 'vk', 'option' );
  $youtube    = get_field( 'youtube', 'option' );
  $drive2     = get_field( 'drive2', 'option' );
  $prado_club = get_field( 'prado-club', 'option' );
  $phone      = get_field( 'phone', 'option' );
  $copyright  = get_field( 'copyright', 'option' );
@endphp

<div class="page__bottom">
  <footer class="footer">
    <div class="footer__container container">
      <div class="footer__top flex">
        <div class="footer__row flex">
          <a class="footer__logo logo" href="{{ home_url('/') }}">
            <svg class="logo__icon" width="150px" height="24px">
              <use xlink:href="{{ svg_sprite_paths() }}#logo"></use>
            </svg>
          </a>
        </div>
        <div class="footer__row flex">
          <div class="footer__text">Федеральная сеть №1 по чип тюнингу Toyota и Lexus</div>
          <div class="phone flex phone_w_text footer__phone"><a class="phone__link" href="{{  'tel:+' . str_replace( [
										")",
										"(",
										" ",
										"-",
                    ], "", $phone ) }}">{{ $phone }}</a>
            <p class="phone__text">Звонок по России бесплатный</p>
          </div>
        </div>
      </div>
      <div class="footer__bottom flex">
        <div class="footer__copyright">&copy; {{ date('Y') }} {{ $copyright }}</div>
        <ul class="social flex footer__social">
          <li class="social__item">
            <a class="social__link" href="{{ $inst }}">
              <svg class="social__icon" width="14" height="14">
                <use xlink:href="{{ svg_sprite_paths() }}#inst-icon"></use>
              </svg>
            </a>
          </li>
          <li class="social__item">
            <a class="social__link" href="{{ $vk }}">
              <svg class="social__icon" width="12" height="12">
                <use xlink:href="{{ svg_sprite_paths() }}#vk-icon"></use>
              </svg>
            </a>
          </li>
          <li class="social__item">
            <a class="social__link" href="{{ $youtube }}">
              <svg class="social__icon" width="14" height="10">
                <use xlink:href="{{ svg_sprite_paths() }}#youtube-icon"></use>
              </svg>
            </a>
          </li>
          <li class="social__item social__item_w_text"><a class="social__link" href="{{ $drive2 }}">DRIVE 2</a>
          </li>
          <li class="social__item social__item_w_text"><a class="social__link" href="{{ $prado_club }}">PRADO-CLUB</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>

  @php
    $popup_title     = get_field( 'popup_title', 'option' );
    $popup_shortcode = get_field( 'popup_shortcode', 'option' );
  @endphp

  <div class="popup mfp-hide" id="sign-up-w-discount">
    <h2 class="popup__title">{{ $popup_title }}</h2>

    {!! do_shortcode($popup_shortcode) !!}
  </div>

</div>
