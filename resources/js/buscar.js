
const lista1 = document.querySelector("#lista1");
const lista2 = document.querySelector("#lista2");
const buscar_origen = document.querySelector("#origen");
const buscar_destino = document.querySelector("#destino");
const fecha1 = document.querySelector("#fecha_ida");
const fecha2 = document.querySelector("#fecha_regreso");

const ida = document.querySelector("#ida");
const ida_vuelta = document.querySelector("#ida_vuelta");

function habilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = true;
    fecha_regreso.required = false;
    
}

function deshabilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = false;
    fecha_regreso.required = true;
}

ida.addEventListener("click", habilitar);
ida_vuelta.addEventListener("click", deshabilitar);


function barra1(){
    
    const li = document.querySelectorAll(".lista1");

    lista1.classList.add("hidden");

    buscar_origen.addEventListener("keyup",()=>{
        let texto = buscar_origen.value.toLowerCase();
        Array.from(li).forEach(e=>{
            let resultados = e.textContent.toLowerCase();
            
            e.classList.add("hidden");
            if(texto !== "" && resultados.startsWith(texto)){
                lista1.classList.remove("hidden");
                e.classList.remove("hidden");
                
                e.addEventListener("click",()=>{select(e,buscar_origen)});
            }

        
        })

    })
    }


function select(element, barra){
    let seleccionado = element.textContent;
    barra.value = seleccionado;
}


function barra2(){
    const li2 = document.querySelectorAll(".lista2");
    lista2.classList.add("hidden");

    buscar_destino.addEventListener("keyup",()=>{
        let texto = buscar_destino.value.toLowerCase();
        console.log("entre en li2")
        Array.from(li2).forEach(e=>{
            
            let resultados = e.textContent.toLowerCase();
            e.classList.add("hidden");
            if(texto !== "" && resultados.startsWith(texto)){
                console.log(e)
                lista2.classList.remove("hidden");
                e.classList.remove("hidden");
                e.addEventListener("click",()=>{select(e,buscar_destino)});
            }
        
        })

    })

}





document.addEventListener("click",()=>{
    lista1.classList.add("hidden");
    lista2.classList.add("hidden");
})



function cambiarfechas() {
    

    const hoy = new Date();

    // Formatear hoy como YYYY-MM-DD
    const yyyy = hoy.getFullYear();
    const mm = String(hoy.getMonth() + 1).padStart(2, '0');
    const dd = String(hoy.getDate()).padStart(2, '0');
    const hoycadena = `${yyyy}-${mm}-${dd}`;

    fecha1.min = hoycadena;
    fecha2.min = hoycadena;



    const maxYYYY = String(hoy.getFullYear());
    const maxMM = String(hoy.getMonth() + 3);
    const maxDD = String(hoy.getDate());
    const maxcadena = `${maxYYYY}-${maxMM}-${maxDD}`;

    fecha1.max = maxcadena;
    fecha2.max = maxcadena;

    console.log("fecha1.min =", fecha1.min);
    console.log("fecha1.max =", fecha1.max);
    console.log("entro en el condicional")
    
}

buscar_origen.addEventListener("keyup", ()=>{
    const lista1 = document.querySelector("#lista1");
    const texto = buscar_origen.value.toLowerCase();
    
    
})
function validar(){
let buscar = document.querySelector("#buscar");
buscar.addEventListener("click",(e)=>{
    e.preventDefault()
    if(fecha2.disabled === false){
        if(fecha2.value < fecha1.value){
        console.log("entro en el condicional")
        alert("la fecha de ida no puede ser mayor a la fecha de vuelta, por favor digite nuevamente los campos");
    }else if (buscar_origen.value.trim() !== "" &&
            buscar_destino.value.trim() !== ""
        ) 
    if (buscar_origen.value === buscar_destino.value) {
                alert("El destino no puede ser igual al origen.");
    } 
}else {
                buscar.submit(); 
            }
    
})}




barra2();
barra1();
cambiarfechas();
validar();