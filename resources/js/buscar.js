const lista1 = document.querySelector("#lista1");
const lista2 = document.querySelector("#lista2");
const buscar_origen = document.querySelector("#origen");
const buscar_destino = document.querySelector("#destino");
const input_origen_id = document.querySelector("#origen_id");
const input_destino_id = document.querySelector("#destino_id");

const ida = document.querySelector("#ida");
const ida_vuelta = document.querySelector("#ida_vuelta");

// Habilitar/Deshabilitar fecha de regreso
function habilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = true;
    fecha_regreso.value = '';
    ida.classList.add('bg-blue-900', 'text-white');
    ida.classList.remove('text-blue-900');
    ida_vuelta.classList.remove('bg-blue-900', 'text-white');
    ida_vuelta.classList.add('text-blue-900');
}

function deshabilitar(){
    const fecha_regreso = document.querySelector("#fecha_regreso");
    fecha_regreso.disabled = false;
    ida_vuelta.classList.add('bg-blue-900', 'text-white');
    ida_vuelta.classList.remove('text-blue-900');
    ida.classList.remove('bg-blue-900', 'text-white');
    ida.classList.add('text-blue-900');
}

ida.addEventListener("click", habilitar);
ida_vuelta.addEventListener("click", deshabilitar);

// Búsqueda en origen
function barra1(){
    const itemsLista1 = lista1.querySelectorAll("li");

    lista1.classList.add("hidden");

    buscar_origen.addEventListener("keyup",()=>{
        let texto = buscar_origen.value.toLowerCase();
        let hayResultados = false;

        itemsLista1.forEach(e=>{
            let resultados = e.textContent.toLowerCase().trim();

            e.classList.add("hidden");
            if(texto !== "" && resultados.includes(texto)){
                lista1.classList.remove("hidden");
                e.classList.remove("hidden");
                hayResultados = true;
            }
        });

        if(!hayResultados && texto !== ""){
            lista1.classList.add("hidden");
        } else if(texto === ""){
            lista1.classList.add("hidden");
        }
    });

    // Click en una ciudad de origen
    itemsLista1.forEach(item => {
        item.addEventListener("click", (e) => {
            e.stopPropagation();
            buscar_origen.value = item.textContent.trim();
            input_origen_id.value = item.getAttribute('value');
            lista1.classList.add("hidden");
        });
    });
}

// Búsqueda en destino
function barra2(){
    const itemsLista2 = lista2.querySelectorAll("li");

    lista2.classList.add("hidden");

    buscar_destino.addEventListener("keyup",()=>{
        let texto = buscar_destino.value.toLowerCase();
        let hayResultados = false;

        itemsLista2.forEach(e=>{
            let resultados = e.textContent.toLowerCase().trim();

            e.classList.add("hidden");
            if(texto !== "" && resultados.includes(texto)){
                lista2.classList.remove("hidden");
                e.classList.remove("hidden");
                hayResultados = true;
            }
        });

        if(!hayResultados && texto !== ""){
            lista2.classList.add("hidden");
        } else if(texto === ""){
            lista2.classList.add("hidden");
        }
    });

    // Click en una ciudad de destino
    itemsLista2.forEach(item => {
        item.addEventListener("click", (e) => {
            e.stopPropagation();
            buscar_destino.value = item.textContent.trim();
            input_destino_id.value = item.getAttribute('value');
            lista2.classList.add("hidden");
        });
    });
}

barra1();
barra2();

// Cerrar listas al hacer click fuera
document.addEventListener("click",(e)=>{
    if (!lista1.contains(e.target) && e.target !== buscar_origen) {
        lista1.classList.add("hidden");
    }
    if (!lista2.contains(e.target) && e.target !== buscar_destino) {
        lista2.classList.add("hidden");
    }
});