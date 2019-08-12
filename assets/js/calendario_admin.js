var mes_text = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    var dia_text = ['Domingo','Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
    // var festivos_mes = ['']

    calen();

    function calen(){
        for(let m = 0; m <= 11; m++){

            let calendario = document.createElement("div");
            calendario.className = "mes";
            document.body.appendChild(calendario);

            let mes = document.createElement("div");
            mes.className = "t-mes";
            mes.textContent = mes_text[m];
            calendario.appendChild(mes);

            let tabla_calendario = document.createElement("table");
            tabla_calendario.className = "semanas";
            calendario.appendChild(tabla_calendario);

            let dias = document.createElement('thead');
            tabla_calendario.appendChild(dias);
            let fila = document.createElement("tr");
            dias.appendChild(fila);
            for(let i = 0; i < dia_text.length; i++){
                let campo = document.createElement('th');
                campo.textContent = dia_text[i];
                fila.appendChild(campo);
            }
            let num_dia = document.createElement('tbody');
            tabla_calendario.appendChild(num_dia);
            for(let f = 0; f < 6; f++){
                let fila = document.createElement("tr");
                num_dia.appendChild(fila);
                for(let d = 0; d < 7; d++){
                    let campo = document.createElement('td');
                    campo.innerText = "";
                    fila.appendChild(campo);
                }
            }
        }
    }

    numerar();  
    
    function numerar(){
        let fecha_año = new Date();
        var año = fecha_año.getFullYear();
        for (i = 1; i < 366; i++) {
            let fecha = fechaPorDia(año, i);
            let mes = fecha.getMonth();
            let select_tabla = document.getElementsByClassName('semanas')[mes];
            let dia = fecha.getDate();
            let dia_semana = fecha.getDay();
            if (dia == 1) {var sem = 0;}
            select_tabla.children[1].children[sem].children[dia_semana].innerText = dia;

            if(select_tabla.children[1].children[sem].children[dia_semana].innerText != "" && dia_semana != 0 && dia_semana != 6){
                select_tabla.children[1].children[sem].children[dia_semana].addEventListener("click", crearEvento);

                function crearEvento(){
                    let r = document.getElementById('nuev-progr');
                    r.style.top = "0";
                    let f = document.getElementsByName('fecha')[0];

                    let ver_fecha = document.getElementById('ver_fecha');
                    ver_fecha.textContent = mes_text[mes] + " " + dia + " de " + año;
                    var mes_env = mes+1;
                    var dia_env = dia;

                    if(mes_env.toString().length < 2){  mes_env = "0" + mes_env; }
                    if(dia_env.toString().length < 2){ dia_env = "0" + dia; }
                    f.setAttribute("value", año + "-" + mes_env + "-" + dia_env);
                    var close = document.getElementById('close-ventana').addEventListener("click", function cerrar(){
                        r.style.top = "-100vh";
                    })
                }
                // MarcarFechas();
            }
            if (dia_semana == 6) { sem = sem + 1; }

        }
        
    }

    let tdsalv = document.getElementsByTagName('td');
    for (let i = 0; i < tdsalv.length; i++) {
        if(tdsalv[i].innerText == ""){
            tdsalv[i].style.background = "#450797";
        }
        
    }
    
    function fechaPorDia(año, dia){
        var fecha = new Date(año, 0);
        return new Date(fecha.setDate(dia));
    }