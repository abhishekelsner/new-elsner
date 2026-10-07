jQuery(document).ready(function($) {
  var t = $(".grid-container"),
      e = $(".grid-container2");

  // Hide the grid containers initially
  t.css({ opacity: 0, visibility: "hidden" });
  e.css({ opacity: 0, visibility: "hidden" });

  // Define a function to show the grid container
  function showGrid() {
    t.css({ opacity: 1, visibility: "visible" });
    e.css({ opacity: 1, visibility: "visible" });
  }

  // Check if Masonry is already loaded, otherwise wait for it
  var isFirstCheck = true;
  function initMasonry() {
    if (typeof $.fn.masonry !== "undefined") {
      t.masonry({
        itemSelector: ".grid-item",
        columnWidth: ".grid-sizer",
        percentPosition: true,
        gutter: 30,
        stagger: 30,
        visibleStyle: {
          transform: "translateY(0)",
          opacity: 1
        },
        hiddenStyle: {
          transform: "translateY(100px)",
          opacity: 0
        },
        horizontalOrder: true
      });
      e.masonry({
        itemSelector: ".grid-item",
        columnWidth: ".grid-sizer",
        percentPosition: true,
        gutter: 30,
        stagger: 30,
        visibleStyle: {
          transform: "translateY(0)",
          opacity: 1
        },
        hiddenStyle: {
          transform: "translateY(100px)",
          opacity: 0
        },
        horizontalOrder: true
      });
      showGrid();
    } else {
      var timeout = isFirstCheck ? 20 : 0; // Adjust the timeout values here
      isFirstCheck = false;
      setTimeout(initMasonry, timeout);
    }
  }

  // Call the function to initialize Masonry and show the grid
  initMasonry();
  jQuery(".category-filter li:nth-child(2)").on("click",function(){
    setTimeout(initMasonry, 200);
});
});
