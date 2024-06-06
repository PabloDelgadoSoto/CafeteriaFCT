var p;
var bocadillo;
var colocar;
var dPrecio;
const miercoles = 3;

window.onload = function(){
    p=document.getElementById('precio');
    bocadillo=document.getElementById('bocadillo');
    colocar=document.getElementById('colocar');
    dPrecio=document.getElementById('prec');
    precio();
}

const precio = async () => {
    let id = document.forms['form']['bocata'].value;
    let tmp;
    await fetch('/ajax?bocata=' + id, { 'method': 'get' }).then(async (response) => { tmp = response });
    tmp = await tmp.json();

    let hoy = new Date();
    let dia = hoy.getDay();
    if(dia == miercoles){
        if(tmp[0].descuento != null){
            let ch = dPrecio.childNodes;
            for(let i = ch.length-1; i >= 1; i--){
                ch[i].remove();
            }
            p.innerHTML=tmp[0].descuento;
            let des = document.createElement('p');
            des.innerHTML='Precio sin descuento: '+tmp[0].precio+' €';
            dPrecio.appendChild(des);
        } else {
            p.innerHTML=tmp[0].precio;
        }
    } else {
        p.innerHTML=tmp[0].precio;
    }
    bocadillo.value=tmp[0].id;

    let ch = colocar.childNodes;
    for(let i = ch.length-1; i >= 1; i--){
        ch[i].remove();
    }
    if(tmp[0].desmontable){
        for(let i = 0; i < tmp[1].length; i++){
            let ing = document.createElement('input');
            let nm = document.createElement('label');
            let br = document.createElement('br');
            ing.setAttribute('name', 'i'+tmp[1][i].id);
            ing.setAttribute('type', 'checkbox');
            ing.checked = true;
            nm.innerHTML = tmp[1][i].nombre;
            colocar.appendChild(ing);
            colocar.appendChild(nm);
            colocar.appendChild(br);
        }
    }

}
