const formulario = document.getElementById('regForm');
const inputBox = formulario.getElementsByClassName('inputBox')[0];
const t_jug = document.getElementById('inp_jugadores');

function val_nombre_e() {

    const input = inputBox.getElementsByTagName('input')[0].value;
    var  inputS = inputBox.getElementsByTagName('input')[0];
    if(input == ""){
        inputS.style.borderBottomColor = "red"; 
        window.scroll(0, 100);
        return false;
    }else{
        inputS.style.borderBottomColor = "#450797";
    }

    var escudo = document.getElementById('escudo');
    var file = escudo.files;

    if(file.length === 0){
        document.getElementById('labes').innerHTML = "Debe seleccionar un escudo <i class='fas fa-image'></i>";
        window.scroll(0,100);
        return false;
    }

    var jug = t_jug.getElementsByTagName('input');
    var jugv = t_jug.getElementsByTagName('input');

    for (let i = 0; i < jug.length; i++) {
        
        if(jugv[i].value == ""){
            jug[i].style.borderBottomColor = "red";
            return false;
        }else{
            jug[i].style.borderBottomColor = "#450797";
        }   
    }

    var jug_g = t_jug.getElementsByClassName('grado');

    for(let ii = 0; ii < jug_g.length; ii++){
        if(
            jug_g[ii].value != "8-1" &&
            jug_g[ii].value != "8-2" &&
            jug_g[ii].value != "8-3" &&
            jug_g[ii].value != "8-4" &&
            jug_g[ii].value != "9-1" &&
            jug_g[ii].value != "9-2" &&
            jug_g[ii].value != "9-3" &&
            jug_g[ii].value != "9-4" &&
            jug_g[ii].value != "10-1" &&
            jug_g[ii].value != "10-2" &&
            jug_g[ii].value != "10-3" &&
            jug_g[ii].value != "10-4" &&
            jug_g[ii].value != "11-1" &&
            jug_g[ii].value != "11-2" &&
            jug_g[ii].value != "11-3" &&
            jug_g[ii].value != "11-4" 
        ){
            jug_g[ii].style.borderBottomColor = "red";
            return false;
        }else{
            jug_g[ii].style.borderBottomColor = "#450797";
        }
    }

    const regl = document.getElementsByName('terminos')[0];
    if(!regl.checked){
        let cds = document.getElementById('fterminos');
        cds.style.color = "red";
        cds.textContent = "Debe haber leído y aceptado el reglamento";
        return false;
    }
}

