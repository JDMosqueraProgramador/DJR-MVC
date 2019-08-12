// Calendario

function pasarCalendario() {
	let fecha = new Date();
	var numCal = fecha.getMonth();
	var mes = classNames("mes");
	var next = id("nextC");
	var pre = id("preC");

	next.addEventListener("click", function CalendarioN() {
		numCal++;
		if (numCal >= mes.length) {
			numCal = 0;
		}

		if (mes[numCal - 1]) {
			mes[numCal - 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		if (mes[numCal + 1]) {
			mes[numCal + 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}

		mes[numCal].style.display = "block";
	});

	pre.addEventListener("click", function CalendarioP() {
		numCal--;
		if (numCal < 0) {
			numCal = mes.length - 1;
		}

		if (mes[numCal + 1]) {
			mes[numCal + 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		if (mes[numCal - 1]) {
			mes[numCal - 1].style.display = "none";
		} else {
			mes[mes.length - 1].style.display = "none";
			mes[0].style.display = "none";
		}
		mes[numCal].style.display = "block";
	});

	mes[numCal].style.display = "block";
}

pasarCalendario();