{{--
  Title: Вопросы и ответы
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

<div class="faq">
  <div class="faq__text text">
    {!! $text !!}
  </div>

  @if ( have_rows( 'faq' ))
  <dl class="faq__list">
    @while (have_rows( 'faq' ))
      @php
        the_row();

        $question = get_sub_field( 'question' );
        $answer   = get_sub_field( 'answer' );

      @endphp
    <div class="faq__item">
      <div class="faq__item-in">
        <dt class="faq__question">{{ $question }}</dt>
        <dd class="faq__answer">
          {!! $answer !!}
        </dd>
      </div>
    </div>
    @endwhile
  </dl>
  @endif
</div>