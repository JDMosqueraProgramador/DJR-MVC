<div class="pass_cal">
    <button id="preC"><i class="fas fa-arrow-left"></i></button>
    <button id="nextC"><i class="fas fa-arrow-right"></i></button>
</div>

<script src="assets/js/calendario_admin.js"></script>
<script src="assets/js/pasarCalendario.js"></script>

<?php 
?>

<div id="inservible"></div>

<script>

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
    // ht.responseType = "json";
    ht.send(send);
}

function marcarFechas(ht){
    var partidos = JSON.parse(ht.responseText);
    for(let e = 0; e < partidos.length; e++){

        const mes = document.getElementsByTagName('table')[partidos[e].mes];
        let dia = mes.getElementsByTagName('td');
        for(let i = 0; i < dia.length; i++){

            let diaNum = parseInt(dia[i].textContent);
            let diaBD = parseInt(partidos[e].dia);

            if(diaNum == diaBD){
                if(dia[i].removeChild(dia[i].lastChild)){
                    alert("Esto sirve para algo");
                }
                let divPartido = document.createElement('div');
                divPartido.className = "partidoDrag";
                divPartido.textContent = partidos[e].nombreLocal+' vs '+partidos[e].nombreVisita;
                divPartido.className = "removeEvent";
                let basura = document.createElement('a');
                basura.className = 'fas fa-trash';
                basura.addEventListener('click', eliminarPartido);
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

            // oc_otro_evento.style.top = '-100vh';
            form_edit.classList.add('top-o');
            document.getElementById('localMod').textContent = partidos[e].nombreLocal;
            document.getElementById('visitaMod').textContent = partidos[e].nombreVisita;

            form_edit.getElementsByTagName('input')[0].value = partidos[e].fechaPartido;
            // form_edit.getElementsByTagName('input')[0].min = '".date('Y-m-d')."';
            // form_edit.getElementsByTagName('form')[0].setAttribute("onclick","partidosAjax('"+partidos[e].idPartido+"', marcharFechas())");

            document.getElementById('close-ventEdit').addEventListener('click', function cerrarEdit(){
                form_edit.classList.remove('top-o');
            });

        }

        // Eliminar un partido

        function eliminarPartido(id){
            let confirm = window.confirm('¿seguro que desea eliminar el encuentro?');
            if(confirm == true){
                partidosAjax("idParEl="+partidos[e].idPartido, marcarFechas);
            }else{
                // const form_edit = document.getElementById('edit_partido');
                // form_edit.classList.remove('top-o');
            }
        }  

    }
}


</script>