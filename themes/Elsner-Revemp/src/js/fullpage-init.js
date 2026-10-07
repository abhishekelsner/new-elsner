jQuery(document).ready(function (e) {
  var n = new fullpage("#fullpage", {
    normalScrollElements: ".header-wrapper .dropdown-menu",
    licenseKey: "gplv3-license",
    dragAndMove: true,
    dragAndMoveKey: "gplv3-license",
    parallax: true,
  
    anchors: [
      "home",
      "expertise",
      "clients",
      "industries",
      "projects",
      "business",
      "partners",
      "life-at-elsner",
      "footer",
    ],
    menu: "#menu",
    scrollingSpeed: 1200,
    touchSensitivity: 4,
    dragAndMove: !0,
    responsiveWidth: 991,
    onLeave: function (n, s, r) {
      if (1 === n.index && "up" === r) {
        e(".header").removeClass("fixed");
        e(".sidebar-menu").removeClass("active");
      } else {
        e(".header").addClass("fixed");
        e(".sidebar-menu").addClass("active");
      }
  
      if (7 === n.index && "down" === r) {
        e(".sidebar-menu").addClass("up-arrow");
      } else {
        e(".sidebar-menu").removeClass("up-arrow");
      }
    },
    afterLoad: function (n, s) {
      if ("industries" === s.anchor) {
        var counterCol = e(".counter-col .timer");
        var counterInView = counterCol.filter(function () {
          var offset = e(this).offset().top;
          var windowHeight = e(window).height();
          return offset <= e(window).scrollTop() + windowHeight;
        });
  
        counterInView.each(function () {
          var counter = e(this);
          if (!counter.hasClass("counted")) {
            counter.prop("Counter", 0).animate(
              { Counter: counter.text() },
              {
                duration: 4000,
                easing: "swing",
                step: function (n) {
                  counter.text(Math.ceil(n));
                },
              }
            );
            counter.addClass("counted");
          }
        });
      }
  
      if ("home" === s.anchor) {
        e(".header").removeClass("fixed");
        e(".sidebar-menu").removeClass("active");
      }
  
      if ("footer" === s.anchor) {
        e(".sidebar-menu").addClass("up-arrow");
      }
    },
  });
  
  e(document).on('click', '#footer', function () {
    fullpage_api.moveTo('home', 1);
  });
  e(document).on("click", "[data-menuanchor]", function () {
    var menuAnchor = e(this).data("menuanchor");
    if (menuAnchor === "footer") {
     scrollToAnchor('home');
    }
  });
  e(".dropdown-toggle").click(function () {
    e("body").hasClass("menu-open")
      ? n.setAllowScrolling(!1)
      : n.setAllowScrolling(!0);
  });
  function scrollToAnchor(aid){
    var aTag = e("a[name='"+ aid +"']");
    e('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

});
