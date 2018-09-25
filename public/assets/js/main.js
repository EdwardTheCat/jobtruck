$(function(){
    console.log('jquery');

    // HOVER JOBTRUCK BUTTON
    var contenuLogo =  $("#nav-jobtruck");
    $('#nav-jobtruck').mouseenter(function() {
       console.log(contenuLogo);
       $(contenuLogo)
           .find("path")
           .css("fill", "#005C7D")
           .css("transform", "scale(1.1, 1)")
           .show(500);
    });

    $('#nav-jobtruck').mouseleave(function() {
       $(contenuLogo)
           .find("path")
           .css("fill", "#FBA919")
           .css("transform", "scale(1)")
           .show(500);
    });
    // FIN HOVER JOBTRUCK BUTTON



    // Animation burger button
/*     $('document').ready(function () {
        var Closed = false;
  
        $('.hamburger').click(function () {
          if (Closed == true) {
            $(this).removeClass('open');
            $(this).addClass('closed');
            Closed = false;
          } else {               
            $(this).removeClass('closed');
            $(this).addClass('open');
            Closed = true;
          }
        });
    }); */

    const menuOne = document.querySelector('.menuOne');

    function addClassFunOne() {
      this.classList.toggle("clickMenuOne");
    }
    menuOne.addEventListener('click', addClassFunOne);



});// FIN DU JS