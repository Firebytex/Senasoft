const li = document.getElementsByTagName("li");
const lista2 = document.querySelector("#lista2");
const buscar_origen = document.querySelector("#origen");
const buscar_destino = document.querySelector("#destino");

function habilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = true;
}


function deshabilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = false;
}





buscar_origen.addEventListener("keyup", ()=>{
    const lista1 = document.querySelector("#lista1");
    const texto = buscar_origen.value.toLowerCase();
    
})