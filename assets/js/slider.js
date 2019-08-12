
// slider

var slideIndex = 0;

function carousel() {
	let i;
	var x = classNames("mySlides");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex > x.length) {
		slideIndex = 1;
	}
	x[slideIndex - 1].style.display = "block";
	setTimeout(carousel, 5000);
}

carousel();