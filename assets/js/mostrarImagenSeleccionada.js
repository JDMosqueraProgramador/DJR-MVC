var input_files = document.getElementById('escudo'), info_es = document.getElementById('labes');
input_files.addEventListener('change', MostrarImagenSeleccionada);
function MostrarImagenSeleccionada() {
    while(info_es.firstChild) {
    info_es.removeChild(info_es.firstChild);
    }

    var curFiles = input_files.files;
if(curFiles.length === 0) {
    var para = document.createElement('span');
    para.textContent = 'No has seleccionado una foto para el escudo';
    info_es.appendChild(para);
} else {
    var list = document.createElement('ul');
    info_es.appendChild(list);
    for(var i = 0; i < curFiles.length; i++) {
    var listItem = document.createElement('li');
    var para = document.createElement('span');
    if(validFileType(curFiles[i])) {
        para.textContent = 'escudo seleccionado: ' + curFiles[i].name ;
        var image = document.createElement('img');
        image.src = window.URL.createObjectURL(curFiles[i]);

        listItem.appendChild(image);
        listItem.appendChild(para);

    } else {
        para.textContent = 'Nombre del archivo ' + curFiles[i].name + ': El archivo seleccionado no es correspondiente.';
        listItem.appendChild(para);
    }

    list.appendChild(listItem);
    }
}
}

var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
]

function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
    if(file.type === fileTypes[i]) {
        return true;
    }
    }

    return false;
}