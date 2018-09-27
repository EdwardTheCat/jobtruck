$(function(){
    /* console.log('jquery'); */

    
/*     $(document).ready(function(){

        // APPEL COOKIEBAR
        $.cookieBar({});

        // HOVER JOBTRUCK BUTTON
        $('#nav-jobtruck')
            .find("path")
            .css("fill", "#FBA919")
            .css("transform", "scale(1)")
            .show(500);
    }); */

    // APPEL COOKIEBAR
    $(document).ready(function(){
        $.cookieBar({
        });
    });
    // FIN APPEL COOKIEBAR

    // HOVER JOBTRUCK BUTTON
    var contenuLogo =  $("#nav-jobtruck");
    $('#nav-jobtruck').ready(function() {
        $(contenuLogo)
            .find("path")
            .css("fill", "#FBA919")
            .css("transform", "scale(1)")
            .show(500);
    });

    var contenuLogo =  $("#nav-jobtruck");
    $('#nav-jobtruck').mouseenter(function() {
       console.log(contenuLogo);
       $(contenuLogo)
           .find("path")
           .css("fill", "#005C7D")
           .css("transform", "scale(1.1) translateX(-2.5%) translateY(-0%)")
           /* .css("transform", "translateX(-0%) translateY(-0%)") */
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

    // HOVER CGU SVG BUTTON
    var cguLogo =  $("#cgu");
    $('#cgu').mouseenter(function() {
       console.log(cguLogo);
       $(cguLogo)
           .find("path")
           .css("transform", "scale(1.05)")
           .show(500);
    });

    $('#cgu').mouseleave(function() {
       $(cguLogo)
           .find("path")
           .css("transform", "scale(1)")
           .show(500);
    });
    // FIN HOVER CGU SVG BUTTON


    // Animation burger button
    const menuOne = document.querySelector('.menuOne');

    function addClassFunOne() {
      this.classList.toggle("clickMenuOne");
    }
    menuOne.addEventListener('click', addClassFunOne);



});// FIN DU JS