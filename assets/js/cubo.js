var cubo = id('cubo');
    
cubo.addEventListener('mousemove', function(evt) {
        var mousePos = getMousePos(cubo, evt);
        var ancho = cubo.width/2;
        var alto = cubo.height/2;
        if(mousePos.y != alto && mousePos.x != ancho){
            cubo.style.transform = "rotateY("+ mousePos.x + "deg) rotateX(-"+ mousePos.y + "deg)";
        }
}, false);

function getMousePos(cubo, evt) {
    return {
        x: evt.clientX,
        y: evt.clientY
    };
}