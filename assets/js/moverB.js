function moverB(es){
    var and = document.getElementById('bandw');
    var bola = document.getElementById('pbw');
    var px = es.clientX;
    var py = es.clientY;
    
    if(px > 150 && py > 0 && px < and.clientWidth - 150){
        bola.style.top = py + "px";
        bola.style.left = px + "px";
    }
}
