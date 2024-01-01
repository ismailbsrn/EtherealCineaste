document.addEventListener('DOMContentLoaded', function () {
  const heroSlider = new Swiper('#hero-slider', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 5000,
    },
    effect: 'slide',
  });

  const onShowSlider = new Swiper('#on-show-slider', {
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 1000,
    },
    autoplay: {
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },

    centeredSlides: true,

    pagination: {
      el: '.swiper-pagination',
      clikable: true,
    },

    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });


});