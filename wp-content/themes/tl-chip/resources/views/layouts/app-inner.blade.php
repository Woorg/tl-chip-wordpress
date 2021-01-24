<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class('page') @endphp>

    @php do_action('get_header') @endphp

    @include('partials.header')

    <main class="page__inner container">
      <div class="page__in">
        <h1 class="page__title title">{{ the_title() }}</h1>
        @yield('content')
      </div>
    </main>

    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
