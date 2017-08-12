/*este js tiene algunas diferencia con el torvicvSlide.js del widget */
jQuery(document).ready(function($){
  
   $(".w3-content br").remove();
   var maxHeight = -1;
   $('.mySlides_plugin').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });
   maxHeight = (maxHeight / 4 ) * 3;
   $('.mySlides_plugin').each(function() {
     $(this).height(maxHeight);
   });
  
  $(".w3-content").height(($(".mySlides_plugin").height() * 2) + 100);  
  $(".mySlides_plugin:gt(2)").css("display","none");
  var porcentajes = [0,37.5,100];
  var porcentajes2 = [-25,37.5,75];
  var v = 0;
  $(".w3-display-right").click(function() {
    v++;
    
    var j = 0;
    var i;
    

    var slides = $(".mySlides_plugin");
   
    for (i = 0; i < slides.length; i++) {
     var slide = slides[i];
     $(slide).removeClass("slide-scale");
     console.log($(slide).height());
     
     if(v >= slides.length){
      v = 0;
    }
     j = v+i;
     if ( j >= 3){
      j=j-slides.length;
     }
     
     $(".activado").next(".mySlides_plugin").addClass("slide-scale");
     
     $(slide).css({ "left": porcentajes2[j]+"%",
       "transition": "left linear 4s",
     });
     if($(".activado:nth-child(1)") && j == 1){
	    $(".mySlides_plugin:nth-child(1)").addClass("slide-scale");
     }else{
  	  $(".mySlides_plugin:nth-child(1)").removeClass("slide-scale");
     }
     $(slide).css("order"); // no eliminar

     if(j <= -1 || j >=3){
      $(slide).css("display", "none");
      //sin esto falla en localhost y en plugin
      $(slide).css("left", "100%");
     }else{
      $(slide).css("display", "block");
     }
     
     if(j == 1){
      $(slide).addClass("activado");
      $(".w3-content").height($(slide).height()*2+100);
     }else{
      $(slide).removeClass("activado");
     }
     
     if($(slide)){
      $(slide).removeClass("class2");
     }
     if(j == 0){
        $(slide).animate({
        "left": "0%",
        "transform": "translate(0%)"
      });
     }
    
    }
  });

  $(".w3-display-left").click(function() {
    v--;
    
    var j = 0;
    var i;
    $(".mySlides_plugin").removeClass("slide-scale");
    var slides = $(".mySlides_plugin");
    var slide = "";
    if(v < 0){
      v = slides.length-1;
    }
    for (i = 0; i < slides.length; i++) {
     slide = slides[i];

     $(".w3-content").height($(slide).height()*2+100);

     j = v+i;
     if ( j > 3){
      j=j-slides.length;
     }
     
     //hace falta llamar antes a porcentajes para que funcione correctamente
     porcentajes[j];
     $(slide).css({ "left": porcentajes[j]+"%",
       "transition": "left linear 4s",
     });
     
     if(j >= 3 || j < 0){
      $(slide).css("display", "none");
      //sin esto falla en localhost y en plugin
      $(slide).css("left", "100%");
     }else{
      $(slide).css("display", "block");
     }
     var largoSlide = slides.length-1;
     if($(".mySlides_plugin:nth("+largoSlide+")").is( $(".mySlides_plugin.activado"))){
      $(".mySlides_plugin:nth("+largoSlide+")").addClass("slide-scale");
     }
     if(j == 1){
      $(slide).addClass("activado");
      $(".activado").prev().addClass("slide-scale");
     }else{
      $(slide).removeClass("activado");
     }
     
     
     if($(slide)){
      $(slide).removeClass("class2");
      
     }
     
    if(j == 2){
        $(slide).animate({
        "left": "75%",
        "transform": "translateX(0%)"
      });
     }
    
    }
  });
});


