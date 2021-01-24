{{--
  Title: О нас
  Category: common
  Mode: edit
  Align: full
  PostTypes: post, page
  SupportsAlign: full
  SupportsMode: true
  SupportsMultiple: true
  SupportsInnerBlocks: true
--}}

@php
  $text_1 = get_field( 'text_1' );
  $link   = get_field( 'link' );
  $text_2 = get_field( 'text_2' );
@endphp


  <div class="about">
     <div class="about__text text">
       {!! $text_1 !!}
       @if ($link)
        <a class="about__link link" href="{{ $link['url'] }}" target="{{ $link['target'] }}">{{ $link['title'] }} <svg class="about__link-icon link__icon" width="22px" height="14px"><use xlink:href="{{ svg_sprite_paths() }}#video-arrow"></use></svg></a>
       @endif

       {!! $text_2 !!}
     </div>

    <div class="about__reviews-w">
      <div class="about__reviews">
      @if (have_rows( 'feedback_instagram' ) )
        @while ( have_rows( 'feedback_instagram' ) ) @php the_row(); @endphp
          @php
            $text       = get_sub_field( 'text' );
            $name       = get_sub_field( 'name' );
            $inst_link  = get_sub_field( 'instagram_link' );
            $images_ids = get_sub_field( 'images' );
            $size       = 'full';
          @endphp

         <article class="about__review">
          <div class="about__review-in">

             <div class="about__review-top flex">
               <div class="about__review-title">{{ $name }}</div>
               <a href="{{ $inst_link }}" class="about__review-link">Instagram</a>
             </div>
             <div class="about__review-body">
              @if ( $images_ids )
              <div class="about__review-images flex">
                @foreach ( $images_ids as $images_id )
                <a class="about__review-image" href="{{ wp_get_attachment_image_url( $images_id, 'full' ) }}">
                  {!! wp_get_attachment_image( $images_id, $size ) !!}
                </a>
                @endforeach
              </div>
              @endif

             </div>
            @if ($text)
              <div class="about__review-text">
                {!! $text !!}
              </div>
            @endif

          </div>

         </article>

        @endwhile

      @endif

      @if ( have_rows( 'video_list' ) )
        @while (have_rows( 'video_list' )) @php the_row(); @endphp
          @php
             $video_title = get_sub_field( 'video_title' );
          @endphp
        <article class="about__review">
          <div class="about__review-in">

            <div class="about__review-top">
              <div class="about__review-title">{{ $video_title }}</div>
            </div>
            <div class="about__review-body">
              @if (have_rows( 'video' ))
                <div class="about__review-videos">
                @while (have_rows( 'video' )) @php the_row(); @endphp
                  <div class="about__video-w vid">
                    <div class="about__video vid__object">
                      {{ the_sub_field( 'iframe' ) }}
                    </div>
                  </div>
                @endwhile
                </div>
              @endif

            </div>

          </div>
         </article>

        @endwhile

      @endif


     </div>
    </div>


   </div>
