{{--
  Title: Контакты
  Category: common
  Mode: edit
  Align: full
  PostTypes: page post
  SupportsAlign: full
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
  $text = get_field( 'text' );
@endphp


<div class="contacts">
  <div class="contacts__text text">
    {!! $text !!}

  </div>
  @if (have_rows( 'russian_cols' ))
  <div class="contacts__row flex">
      @while (have_rows( 'russian_cols' )) @php the_row(); @endphp

        <div class="contacts__col">
          @if (have_rows( 'col' ))
            <ul class="contacts__cities">
              @while (have_rows( 'col' )) @php the_row(); @endphp
                <li class="contacts__city"><a class="contacts__link" href="{{ the_sub_field( 'russian_link' ) }}">{{ the_sub_field( 'russian_city' ) }}</a></li>
              @endwhile
            </ul>
          @endif
        </div>
      @endwhile

  </div>
  @endif

  <div class="contacts__row flex">

    <div class="contacts__col">
      @if ( have_rows( 'kazah_cities' ))
      <div class="contacts__country-foreight">
        <h3 class="contacts__country">Казахстан</h3>
        <ul class="contacts__cities">
          @while (have_rows( 'kazah_cities' )) @php the_row(); @endphp
          <li class="contacts__city"><a class="contacts__link" href="{{ the_sub_field( 'kazah_link' ) }}">{{ the_sub_field( 'kazah_city' ) }}</a></li>
          @endwhile
        </ul>
      </div>
      @endif

      @if (have_rows( 'bulba_cities' ))
      <div class="contacts__country-foreight">
        <h3 class="contacts__country contacts__country_byelarus"> Белоруссия</h3>
        <ul class="contacts__cities">
          @while (have_rows( 'bulba_cities' ))
            @php
              the_row()
            @endphp
            <li class="contacts__city"><a class="contacts__link" href="{{ the_sub_field( 'bulba_link' ) }}">{{  the_sub_field( 'bulba_city' ) }}</a></li>
          @endwhile
        </ul>
      </div>
      @endif

    </div>

    <div class="contacts__col">
      @if ( have_rows( 'ukr_cities' ) )
      <div class="contacts__country-foreight">
        <h3 class="contacts__country">Украина</h3>
        <ul class="contacts__cities">
          @while (have_rows( 'ukr_cities' ))
            @php
              the_row()
            @endphp
            <li class="contacts__city"><a class="contacts__link" href="{{ the_sub_field( 'ukr_link' ) }}">{{ the_sub_field( 'ukr_city' ) }}</a></li>
          @endwhile
        </ul>
      </div>
      @endif

      @if (have_rows( 'mold_cities' ))
      <div class="contacts__country-foreight">
        <h3 class="contacts__country">Молдова</h3>
        <ul class="contacts__cities">
          @while (have_rows( 'mold_cities' ))
            @php
              the_row()
            @endphp
            <li class="contacts__city"><a class="contacts__link" href="{{ the_sub_field( 'mold_city' ) }}">{{ the_sub_field( 'mold_city' ) }}</a></li>
          @endwhile
        </ul>
      </div>
      @endif

    </div>
  </div>
</div>