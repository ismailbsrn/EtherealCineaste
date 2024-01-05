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
      920: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      1080: {
        slidesPerView: 3,
        spaceBetween: 10,
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

  //sandwich menu
  var menuButton = document.getElementById('menuButton');
  var mobileMenu = document.querySelector('.mobile-menu');

  // Open menu on button click
  menuButton.addEventListener('click', function (event) {
    event.stopPropagation(); // Prevents the click event from reaching the document
    mobileMenu.classList.toggle('menu-open');
  });

  // Close menu when clicking anywhere on the page
  document.addEventListener('click', function (event) {
    var isClickInsideMenu = mobileMenu.contains(event.target);
    var isClickOnMenuButton = menuButton.contains(event.target);

    if (!isClickInsideMenu && !isClickOnMenuButton) {
      mobileMenu.classList.remove('menu-open');
    }
  });
});