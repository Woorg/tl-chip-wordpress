{{--
  Template Name: Inner v2
--}}

@extends('layouts.app-inner-v2')

@section('content')

  @while(have_posts()) @php the_post() @endphp
    @php the_content(); @endphp
  @endwhile
@endsection
