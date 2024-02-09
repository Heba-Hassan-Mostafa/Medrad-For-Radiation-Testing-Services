window.onload = function(){
    setInterval(()=>{
      let galleryImg = document.querySelector(".fadeImg img")
      galleryImg.classList.remove("fade-out");
      galleryImg.classList.add("fade-in");
    }, 300); 
  }