// preloader
window.addEventListener('load', () => {
  const loader = document.querySelector('.loader')

  loader.classList.add('loader--hidden')

  loader.addEventListener('transitionend', () => {
    // document.body.removeChild(loader);
    loader.remove()
  })
})
// function for limited text
  $(function(){
    $(".count-limit").keyup(function(){
        $(".counting").text($(this).val().length);
        let x = $(this).val().length;
        if( x >= 200){
            $(this).css({"border":"2px solid red" , "boxShadow": "none"});
            $(".error-msg").show();
        }else{
          $(".error-msg").hide();
          $(this).css({"border" : "none" , "boxShadow": "1px 1px 20px #ddd"});
        }
    })
})
// owl sliders 

$(document).ready(function () {
  $('#owl-comment').owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    // autoPlay: false, //Set AutoPlay to 3 seconds
    items: 3,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3],
  })
  $('#owl-manager').owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
    // autoPlay: false, //Set AutoPlay to 3 seconds
    items: 4,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3],
  })
})
// Scroll to Top
const scrollToTop = document.getElementById('scrollToTop') //get btn Id
window.onscroll = () => {
  // this for scroll to top
  if (window.scrollY >= 700) {
    scrollToTop.style.display = 'block' // check scroll > 600 show btn
  } else {
    scrollToTop.style.display = 'none' // check scroll < 600 hide btn
  }
}
// to top click
scrollToTop.onclick = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth',
  })
}
// animation banner 
// window.addEventListener("screen", () => {
//   let galleryImg = document.querySelector(".galleryImg img")
//   galleryImg.classList.remove("fade-out");
//     galleryImg.classList.add("fade-in");
  
//   console.log(postion)
// })

