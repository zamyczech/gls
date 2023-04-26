document.addEventListener("DOMContentLoaded", function() {
    var navbarToggler = document.querySelector(".navbar-toggler");
    var navbarMenu = document.querySelector(".navbar-collapse");
  
    navbarToggler.addEventListener("click", function() {
      navbarMenu.classList.toggle("show");
    });
  });
  