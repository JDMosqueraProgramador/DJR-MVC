document.addEventListener('DOMContentLoaded', partidosAjax('', marcarFechas));

function partidosAjax(send, action){
    var ht = new XMLHttpRequest;
    ht.addEventListener('readystatechange', function(){

        if(this.status == 200 && this.readyState == 4){
            action(this);
        }

    });
    ht.open('POST', 'controlador/ajax/partidosCRUD.php');
    ht.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ht.send(send);
}

function marcarFechas(ht){
    console.log(ht.responseText);
    var datas = ht.responseText.split('<>', 2);

    // verificar si se envía algún mensaje de acción

    if(datas.length > 1){
        var partidos = JSON.parse(datas[1]);

        // Agregar mensaje de acción

        var mensaje = datas[0];
        var alertAction = document.createElement('div');
        alertAction.className = "alertAction";
        alertAction.textContent = mensaje;
        document.body.appendChild(alertAction);

    }else{
        var partidos = JSON.parse(datas[0]);
    }

    // En caso de, cerrar mensaje de acción
    setTimeout(cerrarAlertAction, 5000);

    for(let e = 0; e < partidos.length; e++){
        const mes = document.getElementsByTagName('table')[partidos[e].mes];
        let dia = mes.getElementsByTagName('td');
        for(let i = 0; i < dia.length; i++){

            let diaNum = parseInt(dia[i].dataset.dia);
            let diaBD = parseInt(partidos[e].dia);

            if(diaNum == diaBD){
                
                // dia[i].removeAttribute('onclick');
                let divPartido = document.createElement('div');
                divPartido.className = "partidoDrag";
                divPartido.textContent = partidos[e].nombreLocal+' vs '+partidos[e].nombreVisita;
                divPartido.className = "removeEvent";
                let basura = document.createElement('a');
                basura.className = 'fas fa-trash';
                basura.setAttribute('onclick', 'eliminarPartido('+i+','+partidos[e].mes+','+partidos[e].idPartido+')');
                divPartido.appendChild(basura);
                divPartido.addEventListener('click', editarPartido);
                dia[i].appendChild(divPartido);
                // dia[i].removeEventListener('click', crearEvento);
                
            }
        }

        // llenar los datos para modificar el partido
        function editarPartido(){   

            const form_edit = document.getElementById('edit_partido');
            const oc_otro_evento = document.getElementById('nuev-progr');

            oc_otro_evento.style.top = '-100vh !important';
            form_edit.classList.add('top-o');
            id('nuev-progr').style.top = "-100vh";
            document.getElementById('localMod').textContent = partidos[e].nombreLocal;
            document.getElementById('visitaMod').textContent = partidos[e].nombreVisita;

            form_edit.getElementsByTagName('input')[0].value = partidos[e].fechaPartido;
            // form_edit.getElementsByTagName('input')[0].min = '".date('Y-m-d')."';
            // form_edit.getElementsByTagName('form')[0].setAttribute("onclick","partidosAjax('"+partidos[e].idPartido+"', marcharFechas())");

            document.getElementById('close-ventEdit').addEventListener('click', function cerrarEdit(){
                form_edit.classList.remove('top-o');
            });

        }

    }
}

// Eliminar un partido

function eliminarPartido(numTD, mes, id){
    let confirm = window.confirm('¿seguro que desea eliminar el encuentro?');
    if(confirm == true){

        const mesT = document.getElementsByTagName('table')[mes];
        let dia = mesT.getElementsByTagName('td')[numTD];
        if(dia.lastChild && dia.lastChild.className == "removeEvent"){
            if(dia.removeChild(dia.lastChild)){
                alert("Esto sirve para algo");
            }else{
                alert('No entiendo que pasa');
            }
        }
        
        document.getElementById('edit_partido').classList.remove('top-o');

        partidosAjax("idParEl="+id, marcarFechas);

    }else{
        // const form_edit = document.getElementById('edit_partido');
        // form_edit.classList.remove('top-o');
    }
}  

id('form-ev').addEventListener('submit', function(e){
    e.preventDefault();
    let fecha = id('fechaNuevoPartido').value;
    let local = id('equipoLocal').value;
    let visita = id('equipoVisita').value;

    if(fecha != "" && local != "" && visita != ""){
        partidosAjax("fecha="+fecha+"&local="+local+"&visita="+visita, marcarFechas);
        id('nuev-progr').style.top = "-100vh";
    }

});

id('edit_partido').addEventListener('submit', function(e){
    e.preventDefault();
    let nuevaFecha = id('nuevaFecha').value;
    if(nuevaFecha != ""){
        partidosAjax("nuevaFecha="+nuevaFecha, marcarFechas);
    }
});