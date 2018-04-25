var slideIndex = 1;

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = x.length} ;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; 
    }
    x[slideIndex-1].style.display = "block"; 
}

$(document).ready(function() {
    showDivs(slideIndex);
    $('.w3-display-left').click(function(e){
        plusDivs(-1);
    });
    $('.w3-display-right').click(function(e){
        plusDivs(+1);
    });
});
