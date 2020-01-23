(function (window, document) {
      
$(document).ready(function(){

$("#submenu").hide(); 

$("#news").hide(500, function(){ alert("Welcome to Bushara Pharmacy" ); });


$(function(){
      
      $("#doc").delay(10000).animate({left:'250px'},"slow"); 
      $("#doc").animate({left:'-=250px'},10000);
      
      $("#px").delay(10000).animate({right:'250px'},"slow"); 
      $("#px").animate({right:'-=250px'},10000);
      
      

});

});

})(window, document);    
 
     
 
$(document).ready(function(){
 
$("#item").click(function(){
 var sb= $("#submenu");
sb.slideDown(5000);

sb.slideUp(10000);

});

});

$(function(){
      $(".gh").delay(10000).css("border","2px solid red");
  /*******
 $("p").css("border","2px solid green");
$("#copyright ").removeAttr("border");
$("#member").removeAttr("border");
$("p.m").removeAttr("border");
$("p.r").removeAttr("border");
**/
});

$(function(){
      $("p").click(function(){
      alert("Hi");
    
      });
});




$(document).ready(function(){
 $("#j5").click(function(){
 
$("#news").slideDown(5000);
$("#news").slideUp(10000, function(){
alert("The blog is for latest update and news \nwhile the forum is for discussion of  selected opportunities and health-related topic.\nDon't forget to visit them to learn");
} );
});
});

$(function()
{
var header = $("nav");
header.animate({opacity:1});
header. animate({height: '+=250px'},3000);
header. animate({height: '-=250px'},3000);

});

$(function(){
    

});

