function mostrarC(){
    var sclick = document.getElementById('omostrar');
    var cambiar = document.getElementById('password');
    var ojo = sclick.getElementsByTagName('i')[0];
    if(cambiar.type == "password"){
        cambiar.type = "text";
        ojo.classList.remove('fa-eye-slash');
        ojo.classList.add('fa-eye');
    }

    else if(cambiar.type == "text"){
        cambiar.type = "password";
        ojo.classList.remove('fa-eye');
        ojo.classList.add('fa-eye-slash');
    }
    
}