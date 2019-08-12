var errorvacio = document.createTextNode("El campo no puede permanecer vacio"),
errorgmail = document.createTextNode("El correo ingresado es incorrecto"),
errorcontra = document.createTextNode("La contraseña debe llevar más de 6 letras"),
errorcargo = document.createTextNode("Debe especificar que cargo ocupa"),
errorgrado = document.createTextNode("El grado ingresado no es correcto"),
validargmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

function validar(){
    const formc = id('c-c');
        //nombre

        var boxinputs = formc.getElementsByClassName('inputBox')[0];
        var inputvalue = boxinputs.getElementsByTagName('input')[0].value,
        inputstyle = boxinputs.getElementsByTagName('input')[0], 
        labelin = boxinputs.getElementsByTagName('label')[0];
        
        
        var errores = id('errores'),
        alerts = errores.getElementsByClassName('alert')[0];
        
        if(inputvalue == ""){
            inputstyle.style.borderBottom = "red solid 1px";
            labelin.style.color = "red";
            alerts.appendChild(errorvacio);
            return false;
        }
        else{
            inputstyle.style.borderBottom = "#270355 solid 1px";
            labelin.style.color = "#270355";
        }

        // apellidos

        var boxinputs1 = formc.getElementsByClassName('inputBox')[1];
        var inputvalue1 = boxinputs1.getElementsByTagName('input')[0].value,
        inputstyle1 = boxinputs1.getElementsByTagName('input')[0], 
        labelin1 = boxinputs1.getElementsByTagName('label')[0];
        
        var alerts1 = errores.getElementsByClassName('alert')[1];
        
        if(inputvalue1 == ""){
            inputstyle1.style.borderBottom = "red solid 1px";
            labelin1.style.color = "red";
            alerts1.appendChild(errorvacio);
            return false;
        }
        else {
            inputstyle1.style.borderBottom = "#270355 solid 1px";
            labelin1.style.color = "#270355";
        }

        //gmail

        var boxinputs2 = formc.getElementsByClassName('inputBox')[2];
        var inputvalue2 = boxinputs2.getElementsByTagName('input')[0].value,
        inputstyle2 = boxinputs2.getElementsByTagName('input')[0], 
        labelin2 = boxinputs2.getElementsByTagName('label')[0];
        
        var alerts2 = errores.getElementsByClassName('alert')[2];
        
        if(inputvalue2 == ""){
            inputstyle2.style.borderBottom = "red solid 1px";
            labelin2.style.color = "red";
            
            alerts2.textContent = "";
            alerts2.appendChild(errorvacio);
            return false;
        }
        else if(!validargmail.test(inputvalue2)){
            inputstyle2.style.borderBottom = "red solid 1px";
            labelin2.style.color = "red";
            alerts2.textContent = "";
            alerts2.appendChild(errorgmail);
            return false;

        }else{
            alerts2.textContent = '';
            inputstyle2.style.borderBottom = "#270355 solid 1px";
            labelin2.style.color = "#270355";
        }

        //contraseña

        var boxinputs3 = formc.getElementsByClassName('inputBox')[3],
        inputvalue3 = boxinputs3.getElementsByTagName('input')[0].value,
        inputstyle3 = boxinputs3.getElementsByTagName('input')[0],
        labelin3 = boxinputs3.getElementsByTagName('label')[0];

        var alerts3 = errores.getElementsByClassName('alert')[3];

        if(inputvalue3 == ""){
            inputstyle3.style.borderBottomColor = "red";
            labelin3.style.color = "red";
            alerts3.textContent = '';
            alerts3.appendChild(errorvacio);
            return false;

        }else if(inputvalue3.length <= 6){
            inputstyle3.style.borderBottomColor = "red";
            labelin3.style.color = "red";
            alerts3.textContent = "";
            alerts3.appendChild(errorcontra);
            return false;
        }

        alerts3.textContent = '';
        inputstyle3.style.borderBottomColor = "#270355";
        labelin3.style.color = "#270355";

        

        // Cargo

        var radios = document.getElementsByName('cargo');
        var alerts4 = errores.getElementsByClassName('alert')[4];
        
            if(radios[0].checked){
                var boxinputs4 = formc.getElementsByClassName('inputBox')[4],
                inputvalue4 = boxinputs4.getElementsByTagName('select')[0].value,
                inputstyle4 = boxinputs4.getElementsByTagName('select')[0];
                labelin4 = boxinputs4.getElementsByTagName('label')[0];

                var alerts5 = boxinputs4.getElementsByClassName('alert')[0]; 

                if(inputvalue4 == ""){
                    inputstyle4.style.borderBottomColor = "red";
                    labelin4.style.color = "red";

                    alerts5.textContent = "";
                    alerts5.textContent = "Debe eligir un grado";
                    
                    return false;
                }
                
                else{
                    inputstyle4.style.borderBottomColor = "#270355";
                    labelin4.style.color = "#270355";
                    alerts5.textContent = "";
                    return true;
                    
                }

            }
            if(radios[1].checked){
                return true;
            }
            else if(!radios[0].checked && !radios[1].checked){
               alerts4.appendChild(errorcargo);
               return false;
           }
       
}




var cantidad = document.getElementById('// nombre que le puso al campo');
var div_total = document.getElementById('// nombre que le puso al div');
var precio = 1000 /* inventando valores */;


cantidad.addEventListener('keyup', function(){
    if(this.value != ""){
        cantidad = parseInt(this.value);

        let total = cantidad * precio;

    }
    div_total.textContent = total;
});


