// ------------------- FORMULARIO PARA ACTUALIZAR REGISTRO ------------------
import { alert,confirmQuestion } from "./helper/sweetAlert.js"; // Alertas
import { toolbarOptions } from "./helper/optionsEditor.js"; // Configuración del editor
import { validarForm,campos } from "./helper/regex.js"; // Validaciones.

let data = [];
const admin = document.getElementById("admin"), 
    noEditor = document.getElementById("formNoEditor"), 
    withEditor = document.getElementById("formWithEditor"), // Formularios con editor
    atras = document.getElementById("atras"); // Botón atrás de los formularios

if(admin){
    var formulario = admin, inputs = document.querySelectorAll('#admin input'); // Obtener todos los inputs.
}else if(noEditor){
    var formulario = noEditor, inputs = document.querySelectorAll('#formNoEditor input');
}else if(withEditor){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    var formulario = withEditor, inputs = document.querySelectorAll('#formWithEditor input');
}

inputs.forEach((input) => { // Hacer validaciones 
    input.addEventListener('keyup', validarForm); // Soltar una tecla
    input.addEventListener('blur', validarForm); // Salir del input
});

const send = (route,form,checkbox,action)=>{ // MANDAR DATOS A PHP
    fetch(route,{
        method: 'POST',
        body: form
    }).then( (res) => res.text()).then( (data) => {
        console.log(data);
        alert(data,checkbox, action);  // Llamada a función para una alerta de acuerdo al formulario
    });
}
if(noEditor){
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        let form = new FormData(formulario);
        // Validar si se recibe algo del input file
        (form.get("archivo"))? ((form.get("archivo").length === undefined) ? campos.archivo=true:campos.archivo= false) : "";
        // Se usa el input que se colocó en el formulario como identificador
        if(form.get("table") === "galeria"){
            data = [campos.nom_foto,campos.descripcion,campos.archivo,true,true,true];
        }else if(form.get("table") === "documento"){
            data = [campos.nombre,campos.descripcion,campos.archivo,true,true,true];
        }else if(form.get("table") === "categoria"){
            data = [campos.cateoria,true,true,true,true,true];
        }else if(form.get("table") === "directorio"){
            data = [campos.nombre,campos.url,campos.estado,campos.carrera,campos.email,campos.telefono];
        }

        if(form.get("table") === "imageNewsUp"){ // Form para actualizar imágenes seleccionados
            let checks = document.querySelectorAll(".check_foto");
            let checkbox = [];
            checks.forEach((el) => { // Obtener todos los checkboxs seleccionados
                if(el.checked == true){
                    checkbox.push(el.value);
                }
            });
            let $total = document.getElementById("total").value;
            if(checkbox.length === 0){ //Guardar noticia sin ninguna imágen
                confirmQuestion("../../main.php?p=noticias","Eliminar imágenes",`No ha seleccionado ninguna imágen para la noticia, ¿Está seguro de continuar?, esta acción eliminará la referencia de las imágenes a esta noticia.`, form);
            }else if(checkbox.length == $total.toString()){ // SI NO HUBO CAMBIOS EN LA SELECCIÓN MANDAR UNA ELERTA
                alert("equal",0,"mod");  
            }else{
                form.append("id_foto[]", checkbox);
                let msgNews = `Ahora esta noticia tendrá ${(checkbox.length === 1)? `1 imágen` : `${checkbox.length} imágenes`} , ¿Quiere continuar con la eliminación?`;  
                confirmQuestion("../../main.php?p=noticias", "Guardar cambios", `${msgNews}`, form); // ALERTA CONFIRMACIÓN DE CAMBIOS
            }
        }else{
            let result = data.filter(f => f === false); // Filtrar si hay un campo en false en el arreglo, si hay 0 ejecutamos lo siguiente
            if(result.length === 0){ // VALIDAR QUE TODOS LOS DATOS DEL ARREGLO SON VERDADEROS
                if(form.get("table") !== "imageNews"){
                    document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
                };
                send("receivedData.php",form,0,"mod"); // Llamamos la función para mandar los datos
            }else{
                if(form.get("table") === "imageNews") return;
                document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
            }
        }
    });
}else if(withEditor){ 
    formulario.addEventListener('submit',(e) => {
        e.preventDefault();
        document.getElementById("texto").value = quill.container.firstChild.innerHTML; // MANDAMOS EL TEXTO DEL editor AL INPUT
        let form = new FormData(formulario);
        let cuerpo = true;
        if(form.get("table") == "noticia"){
            data = [campos.titulo,campos.descripcion,cuerpo];
        }
        form.get("table");
        let result = data.filter(f => f === false);
        if(result.length === 0){
            document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
            send("receivedData.php",form,0,"mod");
        } else {
            document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
        }
    });
}
if(atras){ // Evento al dar click en botón atrás
    atras.addEventListener("click", (e) => {
        e.preventDefault();
        window.history.back();
    })
}