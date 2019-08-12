const form = id("form-partido");
var golesLocal = form.getElementsByClassName('golesLocal');
var golesVisita = form.getElementsByClassName('golesVisita');

var totalL = 0, total = 0;

for(let i = 0; i < golesLocal.length; i++){
    golesLocal[i].addEventListener('change', sumarTotalLocal);

    function sumarTotalLocal(){
        if(this.value != ""){
            totalL += parseInt(this.value); 
            id('resultL').textContent = totalL;
        }else{
            form.addEventListener('submit', function(e){
                e.preventDefault();
                this.style.borderColor = 'red';
                return false;
            });
        }
    }
}

for(let i = 0; i < golesVisita.length; i++){
    golesVisita[i].addEventListener('change', sumarTotalVisita);

    function sumarTotalVisita(){
        if(this.value != ""){

            var almacenValores = [];
            almacenValores[i] = parseInt(this.value);

            if(almacenValores[i]){
                total = total-almacenValores[i];
            }
            total += parseInt(this.value); 
            // this.removeEventListener('change', sumarTotalVisita);
            id('resultV').textContent = total;
        }
        else{
            form.addEventListener('submit', function(e){
                e.preventDefault();
                this.style.borderColor = 'red';
                return false;
            });
        }
    }
}

// amarillas

var amarillasL = document.getElementsByClassName('amarillalocal'); 
var totAL = 0;
for(let i = 0; i < amarillasL.length; i++){
    amarillasL[i].addEventListener('change', contarAmarillasL);
    function contarAmarillasL(){
        if(this.checked == true){
            totAL++;
        }else{
            totAL--;
        }
        id('amL').textContent = totAL;
    }
}

var amarillasV = document.getElementsByClassName('amarillavisita');
var totAV = 0;
for(let i = 0; i < amarillasV.length; i++){
    amarillasV[i].addEventListener('change', contarAmarillasV);
    function contarAmarillasV(){
        if(this.checked == true){
            totAV++;
        }else{
            totAV--;
        }
        id('amV').textContent = totAV;
    }
}

// rojas

var rojasL = document.getElementsByClassName('rojalocal');
var totRL = 0;
for(let i = 0; i < rojasL.length; i++){
    rojasL[i].addEventListener('change', contarRojasL);
    function contarRojasL(){
        if(this.checked == true){
            totRL++;
        }else{
            totRL--;
        }
        id('roL').textContent = totRL;
    }
}

var rojasV = document.getElementsByClassName('rojavisita');
var totRV = 0;
for(let i = 0; i < amarillasV.length; i++){
    rojasV[i].addEventListener('change', contarRojasV);
    function contarRojasV(){
        if(this.checked == true){
            totRV++;
        }else{
            totRV--;
        }
        id('roV').textContent = totRV;
    }
}

