function editarJugador(name, apellidos, grado, idE){
    id('nombreNuevo').value = name;
    id('apellidosNuevo').value = apellidos;
    id('grupoNuevo').value = grado;
    id('idNuevo').value = idE;

    classNames('editJugador')[0].style.top = '0';

}


function mostrarEsaCosa(){
    var x = document.getElementsByClassName("agg")[0];
    if(x.style.top == "-100vh"){
        x.style.top = "0";
    }else{
        x.style.top = "-100vh";
    }
}

function cerrarAlertAction(){
    var alerts = classNames('alertAction');
    for(let i = 0; i < alerts.length; i++){
        alerts[i].style.opacity = "0";
        setTimeout(function(){
            alerts[i].style.display = 'none';
            classNames('inputs-jug')[0].removeChild(alerts[i]);
            }, 1000);
    }
}