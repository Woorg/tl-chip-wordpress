import svg4everybody from 'svg4everybody';
import Swiper, { Pagination } from 'swiper';
// import { tns } from "tiny-slider/src/tiny-slider";
import $ from 'jquery';


(function ($) {

  svg4everybody();

  let styles = [
    'padding: 2px 9px',
    'background: #1b1e64',
    'color: #fff',
    'display: inline-block',
    'box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.2) inset, 0 5px 3px -5px rgba(0, 0, 0, 0.5), 0 -13px 5px -10px rgba(255, 255, 255, 0.4) inset',
    'line-height: 1.52',
    'text-align: left',
    'font-size: 14px',
    'font-weight: 400'
  ].join(';');

  console.log('%c developed by igor gorlov gorlov https://igrlv.ru', styles);

  /*
    Lazyload images
  */

  let lazyLoadInstance = new LazyLoad({
    elements_selector: '.lazy',
    load_delay: 50,
    use_native: false
  });

  if (lazyLoadInstance) {
    lazyLoadInstance.update();
  }


  $(function() {

    // Nav

    const $header = $('.header');
    const $navTrigger = $('.nav__trigger');
    const wW = $(window).outerWidth();

      $navTrigger.on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('nav__trigger_active');
        $header.toggleClass('header_open');

      });


    $(window).on('resize', function() {
      let wW = $(window).outerWidth();
      // console.log(wW);
      if (wW >= 1201) {
        $navTrigger.removeClass('nav__trigger_active');
        $header.removeClass('header_open');

      }

    });



    // Close nav

    $(document).on('click', function (e) {
      if (!$(e.target).closest('.nav__trigger_active').length) {
        $navTrigger.removeClass('nav__trigger_active');
        $header.removeClass('header_open');

      }
    });



    // HeroSlider

    Swiper.use([Pagination]);

    const $heroSlider = $('.hero__slider');

    if ($heroSlider.length > 0) {

      const $heroSwiper = new Swiper('.hero .swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        // loop: true,

        // If we need pagination
        pagination: {
          el: '.hero__pagination',
          clickable: true
        },

      });
    }

  // Feedback slider

  const $feedbackSlider = $('.feedback__slider');

  if ($feedbackSlider.length > 0) {

    const $feedbackSwiper = new Swiper('.feedback .swiper-container', {
      // Optional parameters
      direction: 'horizontal',
      // loop: true,
      slidesPerView: 2,

      // If we need pagination
      pagination: {
        el: '.feedback__pagination',
        clickable: true
      },

      breakpoints: {
        0: {
          slidesPerView: 1
        },
        640: {
          slidesPerView: 2
        }
      }

    });

  }


  // Popup

  $('.open-popup').magnificPopup({
    type: 'inline'
  });


  // Gallery

  $('.card__photo, .feedback__image').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });


  $('.feedback__image').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });

  $('.trusted__object').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });


  // List pages

  function pageWidget(pages) {
    var widgetWrap = $('<div class="widget_wrap"><ul class="widget_list"></ul></div>');
    widgetWrap.prependTo("body");
    for (var i = 0; i < pages.length; i++) {
      $('<li class="widget_item"><a class="widget_link" href="' + pages[i] + '.html' + '">' + pages[i] + '</a></li>').appendTo('.widget_list');
    }
    var widgetStilization = $('<style>body {position:relative} .widget_wrap{position:absolute;top:0;left:0;z-index:9999;padding:10px 20px;background:#222;border-bottom-right-radius:10px;-webkit-transition:all .3s ease;transition:all .3s ease;-webkit-transform:translate(-100%,0);-ms-transform:translate(-100%,0);transform:translate(-100%,0)}.widget_wrap:after{content:" ";position:absolute;top:0;left:100%;width:24px;height:24px;background:#222 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAgMAAABinRfyAAAABGdBTUEAALGPC/xhBQAAAAxQTFRF////////AAAA////BQBkwgAAAAN0Uk5TxMMAjAd+zwAAACNJREFUCNdjqP///y/DfyBg+LVq1Xoo8W8/CkFYAmwA0Kg/AFcANT5fe7l4AAAAAElFTkSuQmCC) no-repeat 50% 50%;cursor:pointer}.widget_wrap:hover{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);transform:translate(0,0)}.widget_item{padding:0 0 10px}.widget_link{color:#fff;text-decoration:none;font-size:15px;}.widget_link:hover{text-decoration:underline} </style>');
    widgetStilization.prependTo(".widget_wrap");
  }


  pageWidget([
    'index',
    'car',
    'contacts',
    'faq',
    'feedback',
    'feedback-v2',
    'warranty',
    'catalog',
    'car',
    'car-v2',


  ]);




});




})(jQuery);
