document.addEventListener('DOMContentLoaded', crudJugadores("editar="+idEquipo));


function crudJugadores(send){
    ht = new XMLHttpRequest;
    ht.addEventListener('readystatechange', function(){
        if(this.readyState == 4 && this.status == 200){
            classNames('inputs-jug')[0].innerHTML = this.responseText;
            setTimeout(cerrarAlertAction, 5000);
        }
    });
    ht.open('POST', 'controlador/ajax/jugadoresCRUD.php');
    ht.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ht.send(send);
}

classNames('editJugador')[0].addEventListener('submit', function(e){
    e.preventDefault();
    if(id('nombreNuevo').value != "" && id('apellidosNuevo').value != "" && id('grupoNuevo').value != ""){

        crudJugadores("editar="+idEquipo+"&nvNombre="+id('nombreNuevo').value+"&nvApellidos="+id('apellidosNuevo').value+"&nvGrupo="+id('grupoNuevo').value+"&idEd="+id('idNuevo').value);

        classNames('editJugador')[0].style.top = '-100vh';


    }
});
