$(document).ready(function(){
  $('.photo-carousel').slick({
    autoplay: true,
    autoplaySpeed: 4000,
    cssEase: "cubic-bezier(.8,0,.2,1)",
    fade: true,
    dots: true,
    prevArrow: "<i class='icon icon-prev ion-ios-arrow-back'></i>",
    nextArrow: "<i class='icon icon-next ion-ios-arrow-forward'></i>"
  });
});