/* scroll button  */
$(document).ready(function() {
    $('a[href*="#"]').on('click', function(e) {
      e.preventDefault();
      $('html').animate({
        scrollTop: $($(this).attr('href')).offset().top
      }, 1000);
    });
    
  });

//for log.php
  function viewPasswordLog() {
  var passwordInput = document.getElementById('password-field');
  var passStatus = document.getElementById('pass-status');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash'; 
  }
  else {
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
  }
}

// for register.php
function viewPasswordSign()
{
  var passwordInput = document.getElementById('password-field2');
  var passStatus = document.getElementById('pass-status2');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
  }
  else {
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
  }
}

function handleClick(val){
  document.getElementById('HiddenInputID').value = val;
  return true;
}

function changeIcon() {
  var searchIcon = document.getElementById('srch');
  searchIcon.className='fa fa-close';
}

$(function() {
  $(".searchIcon").on("click",function() {
    $(".search").toggleClass("active");
    $(this).toggle()
    $(this).siblings().toggle()
  });
});


// slideshows that display user's comment
const slideshows = document.querySelectorAll(".slideshow");

slideshows.forEach((slideshow) => {
  var dots = slideshow.querySelectorAll(".dot");
  var prev = slideshow.querySelector(".prev");
  var next = slideshow.querySelector(".next");

  var slideIndex = 1;
  showSlides(slideIndex);

  prev.addEventListener("click", () => showSlides((slideIndex -= 1)));
  next.addEventListener("click", () => showSlides((slideIndex += 1)));

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => showSlides((slideIndex = i + 1)));
  });

  function showSlides(n) {
    var i;
    var slides = slideshow.getElementsByClassName("mySlides");

    if (n > slides.length) {
      slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
  }
});


// slideshow with MY POSTS/ FAVOURITE POSTS
var slideIndex2 = 1
showSlides2(slideIndex2);

function plusSlides2(n) {
  showSlides2(slideIndex2 += n);
}

function currentSlide2(n) {
  showSlides2(slideIndex2 = n);
}

function showSlides2(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides3");
  var dots = document.getElementsByClassName("dot3");
  if (n > slides.length) {slideIndex2 = 1}    
  if (n < 1) {slideIndex2 = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex2-1].style.display = "block";  
  dots[slideIndex2-1].className += " active";
}

function showPosts() {
    var x = document.getElementById("posts");
    var y = document.getElementById("favs");
    var btn1 = document.getElementById("prev3");
    var btn2 = document.getElementById("next3");

    if(x.style.display == 'none'){
        x.style.display = 'block';
        y.style.display = 'none';
        btn2.className = 'next3';
        btn1.className = 'prev3 active';
    } 
    return false; 
}

function showHelp() {
    var x = document.getElementById("helpPopup");

    if(x.style.display == 'none'){
      x.style.display = 'block';
    } else {
      x.style.display = 'none';
    }
    return false; 
}

function showFavs() {
    var y = document.getElementById("posts");
    var x = document.getElementById("favs");
    var btn1 = document.getElementById("next3");
    var btn2 = document.getElementById("prev3");

    if(x.style.display == 'none'){
        x.style.display = 'block';
        y.style.display = 'none';
        btn2.className = 'prev3';
        btn1.className = 'next3 active';
    }     
    return false;
}

function showLoadingAnimation() {
  var x = document.getElementById("loadingDiv");

  if(x.style.display == 'none') {
      x.style.display = 'block';
  }

  return false;
}

//toggle notification icon
function toggleNotification(x) {
  x.classList.toggle("fa-thumbs-down");
}

function openLogIn() {
  window.location.assign("explore.php");
}

function closeConfirmation() {
  var x = document.getElementById("code_confirmation");

  if(x.style.display == 'none'){
      x.style.display = 'block';
  }
  else {
      x.style.display = 'none';
  }

  return false;
}

function openTypeCode() {
  var x = document.getElementById("confirmationCode");
  if(x.style.display == 'none'){
      x.style.display = 'block';
      var y = document.getElementById("code_confirmation");
      y.style.display = 'none';
  }
  return false;
}
 

