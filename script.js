$(document).ready(function() {
  // Change the slide every 5 seconds
  setInterval(function() {
    // Get the active slide
    var activeSlide = $('.swiffy-slider .slide-visible');

    // Get the next slide
    var nextSlide = activeSlide.next();

    // If there is no next slide, go back to the first slide
    if (!nextSlide.length) {
      nextSlide = $('.swiffy-slider li:first-child');
    }

    // Show the next slide
    activeSlide.removeClass('slide-visible');
    nextSlide.addClass('slide-visible');
  }, 5000); // 5000 milliseconds = 5 seconds
});
