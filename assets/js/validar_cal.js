const form_c_partido = document.getElementById('form-ev');
let selecton = form_c_partido.getElementsByTagName('select');

form_c_partido.addEventListener('submit', equiposDistintos);

function equiposDistintos(evt) {

    if(selecton[1].value == selecton[0].value){
        evt.preventDefault();
        alert('Los equipos no pueden ser el mismo');
        return false;
    }
    
}


