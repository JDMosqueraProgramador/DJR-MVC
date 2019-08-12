
var cards = classNames('card');

for(let i = 0; i < cards.length; i++){
    var infos = cards[i].getElementsByClassName('info')[0];
    var go_back = cards[i].getElementsByClassName('go-back')[0];

    var atras = cards[i].getElementsByClassName('atras')[0];
    var delante = cards[i].getElementsByClassName('delante')[0];

    infos.addEventListener('click', function(){
        atras.className += " active-r";
        delante.classList.remove('active-r');
    });

    go_back.addEventListener('click', function(){
        delante.className += " active-r";
        atras.classList.remove('active-r');
    });
}