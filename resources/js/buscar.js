const li = document.getElementsByTagName("li");
const lista2 = document.querySelector("#lista2");
const buscar_origen = document.querySelector("#origen");
const buscar_destino = document.querySelector("#destino");

const ida = document.querySelector("#ida");
const ida_vuelta = document.querySelector("#ida_vuelta");

function habilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = true;
}

function deshabilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = false;
}

ida.addEventListener("click", habilitar);
ida_vuelta.addEventListener("click", deshabilitar);


function barra1(){
    const lista = document.querySelector("#lista1");
    const li = document.getElementsByTagName("li");
    const origen = document.querySelector("#origen");

    origen.addEventListener("keyup",()=>{
        let texto = origen.value.toLowerCase();

        Array.from(li).forEach(e=>{
            let resultados = e.textContent.toLowerCase();
            if(texto !== "" && resultados.startsWith(texto)){
                console.log(e)
                lista.classList.toggle = ("block");
                e.classList.toggle =("block");
            }
            else{
                lista.style.display =("none");
            }
        })

    })

    
}
 barra1();




buscar_origen.addEventListener("keyup", ()=>{
    const lista1 = document.querySelector("#lista1");
    const texto = buscar_origen.value.toLowerCase();
    
})