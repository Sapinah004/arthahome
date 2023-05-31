// Change navbar color when scrolling
const nav = document.querySelector('nav');
window.addEventListener('scroll', () => {
if(window.scrollY >= 50){
 nav.classList.add('active_nav');
}else{
    nav.classList.remove('active_nav')
}
})

// Toogle Navigation Mobile
const toggle = document.querySelector("#toggleMenu");
const menu = document.querySelector("#androidMenu");

toggle.addEventListener("click", function(){
  menu.classList.toggle("is-hidden");
})

// Swiper Fasilities
var swiper = new Swiper(".swiperFacilities", {
  slidesPerView: "auto",
  spaceBetween: 30,
  scrollbar: {
    el: ".swiper-scrollbar",
    hide: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  }
});

// Swiper Gallery
var swiper = new Swiper(".swiperGallery", {
  slidesPerView: "auto"
});

// // galeri

let body = document.querySelector(".image-gallery"),
lightBox = document.querySelector(".lightBox"),
img = document.querySelectorAll(".gImg"),
showImg = lightBox.querySelector(".showImg img"),
closeIcon = lightBox.querySelector(".close");

for(let image of img){
  image.addEventListener("click",()=>{
    lightBox.style.display = "block";
    showImg.src = image.src;
    closeIcon.addEventListener("click", ()=>{
      lightBox.style.display = "none";
    });
  })
}

// function agar tidak resubmission ketika refresh browser
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

