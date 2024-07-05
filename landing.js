var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

$(document).ready(function () {
  $("input[type=file]").change(function () {
    //console.log(this.files);
    var f = this.files;
    var el = $(this).parent();
    if (f.length > 1) {
      console.log(this.files, 1);
      el.text("Sorry, multiple files are not allowed");
      return;
    }
    // el.removeClass('focus');
    el.html(
      f[0].name +
        "<br>" +
        '<span class="sml">' +
        "type: " +
        f[0].type +
        ", " +
        Math.round(f[0].size / 1024) +
        " KB</span>"
    );
  });

  $("input[type=file]").on("focus", function () {
    $(this).parent().addClass("focus");
  });

  $("input[type=file]").on("blur", function () {
    $(this).parent().removeClass("focus");
  });
});
