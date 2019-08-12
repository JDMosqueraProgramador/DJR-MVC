function formL(i, l) {
	var input = tagNames("input")[i].value;
	var label = tagNames("label")[l];

	if (input != "") {
		label.classList.add("focus");
	} else {
		label.classList.remove("focus");
	}
}