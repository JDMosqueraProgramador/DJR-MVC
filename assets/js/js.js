// menu Responsive

function myFunction() {
	var x = id("MenuResponsive");
	if (x.className == "menu2") {
		x.className += " menualv";
	} else {
		x.className = "menu2";
	}
}

function mcal() {
	var calendario = id("calendario");
	calendario.classList.toggle("mcalendario");

	window.addEventListener('click', function(e){
		if(e.target != calendario){
			calendario.classList.remove('mcalendario');
		}
	}, true);
}



// scroll menu

function ScrollMenu() {
	var menu3 = id("menu3");
	var menu = id("menuF");
	var altura = menu3.offsetTop + menu3.offsetHeight;
	window.addEventListener("scroll", function () {
		if (window.pageYOffset > altura) {
			menu.classList.add("fixed");
		} else {
			menu.classList.remove("fixed");
		}
	});
}

// drop clic

function drop() {
	id("activeDrop").classList.toggle("responsive");
}

// ventana modal

function venM() {
	id("nuev-progr").classList.toggle("top-o");
}


//arrastrar

function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	ev.target.appendChild(document.id(data));
}

// Formularios

function formF() {
	var formi = id("iniciar-sesion");
	var inputf = formi.getElementsByTagName("input")[0].value,
		inputf = formi.getElementsByTagName("input")[0],
		inputf1 = formi.getElementsByTagName("input")[1].value,
		inputfs1 = formi.getElementsByTagName("input")[1];

	if (inputf1 == "") {
		inputfs1.style.borderBottom = "solid 1px red";
		return false;
	} else {
		inputf1.style.borderBottom = "solid 1px purple";
	}

	if (inputf == "") {
		inputfs.style.borderBottom = "solid 1px red";
		return false;
	} else {
		inputf.style.borderBottom = "solid 1px purple";
	}
}

// labels

function menu_2(x) {
	var menu = id("menu2");
	var y = menu.getElementsByTagName("li")[x];
	y.classList.add("active-menu2");
}

function menu_3(x) {
	var menu = id("menu3");
	var y = menu.getElementsByTagName("a")[x];
	y.classList.add("active-link");
}

