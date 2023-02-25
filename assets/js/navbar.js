
document.addEventListener('DOMContentLoaded', () => {
    var button = document.querySelector(".bar-mobile");

    var dropdownMobile = document.querySelector(".dropdown-mobile");

    var cross = document.querySelector(".cross");

    var bar = document.querySelector(".bar");


    button.addEventListener("click", (event) => {
        dropdownMobile.classList.toggle("show-dropdown-mobile");

        cross.classList.toggle("show");
    
        bar.classList.toggle("show");
    });


      var arrow = document.querySelectorAll(".mobile-title-nav");

      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            var arrowParent = e.target.nextElementSibling;
            
            console.log(e.target); 
            if (arrowParent != null) {
                arrowParent.classList.toggle("show");
            }
            
        });
      }

})



