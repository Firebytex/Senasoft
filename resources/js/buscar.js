const li = document.getElementsByTagName("li");
const lista1 = document.querySelector("#lista1");
const lista2 = document.querySelector("#lista2");
const buscar_origen = document.querySelector("#origen");
const buscar_destino = document.querySelector("#destino");

const ida = document.querySelector("#ida");
const ida_vuelta = document.querySelector("#ida_vuelta");

function habilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = true;
    const fecha = new Date();
    const fecha_nueva = fecha.getMonth() + 3;
    console.log(fecha);
    console.log(fecha_nueva.toString());
}

function deshabilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = false;
}

ida.addEventListener("click", habilitar);
ida_vuelta.addEventListener("click", deshabilitar);


function barra1(){
    
    const li = document.getElementsByTagName("li");
    const origen = document.querySelector("#origen");

    lista1.classList.add("hidden");

    origen.addEventListener("keyup",()=>{
        let texto = origen.value.toLowerCase();
        Array.from(li).forEach(e=>{
            let resultados = e.textContent.toLowerCase();
            
            e.classList.add("hidden");
            if(texto !== "" && resultados.startsWith(texto)){
                console.log(e)
                lista1.classList.remove("hidden");
                e.classList.remove("hidden");
            }
        
        })

    })
    }

function barra2(){
    const li = document.getElementsByTagName("li");
    const origen = document.querySelector("#destino");

    lista2.classList.add("hidden");

    origen.addEventListener("keyup",()=>{
        let texto = origen.value.toLowerCase();
        Array.from(li).forEach(e=>{
            let resultados = e.textContent.toLowerCase();

            e.classList.add("hidden");
            if(texto !== "" && resultados.startsWith(texto)){
                console.log(e)
                lista2.classList.remove("hidden");
                e.classList.remove("hidden");
            }
        
        })

    })

}

barra2()
    

barra1();



document.addEventListener("click",()=>{
    lista1.classList.add("hidden");
    lista2.classList.add("hidden");
})



buscar_origen.addEventListener("keyup", ()=>{
    const lista1 = document.querySelector("#lista1");
    const texto = buscar_origen.value.toLowerCase();
    
})