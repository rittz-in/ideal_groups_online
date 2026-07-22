// An object literal
var app = {
  init: function () {
    app.functionOne();
  },
  functionOne: function () {},
  scrollTop: function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  },
};
(function () {
  // your page initialization code here
  // the DOM will be available here
  app.init();
})();

$(function () {
  var header = $("header");
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 500) {
      header.removeClass("header").addClass("darkHeader");
    } else {
      header.removeClass("darkHeader").addClass("header");
    }
  });
});

$("#image-slider").owlCarousel({
  dots: false,
  nav: true,
  navText: [
    "<i class='fal fa-long-arrow-left'></i>",
    "<i class='fal fa-long-arrow-right'></i>",
  ],
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
    },
    1024: {
      items: 4,
    },
  },
});

$("#image-card-slider").owlCarousel({
  dots: false,
  margin: 30,
  nav: true,
  center: true,
  loop: true,
  navText: [
    "<i class='fal fa-long-arrow-left'></i>",
    "<i class='fal fa-long-arrow-right'></i>",
  ],
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
    },
    1024: {
      items: 3,
    },
  },
});

$("#team-card-slider").owlCarousel({
  dots: false,
  margin: 15,
  nav: true,
  center: true,
  loop: true,
  navText: [
    "<i class='fal fa-long-arrow-left'></i>",
    "<i class='fal fa-long-arrow-right'></i>",
  ],
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
    },
    1024: {
      items: 5,
    },
  },
});
