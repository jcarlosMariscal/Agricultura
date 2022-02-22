// VALIDACIÓN DE FORMULARIOS PARA AGREGAR REGISTROS
import { alert } from "./helper/sweetAlert.js"; // Aalertas
import { toolbarOptions } from "./helper/optionsEditor.js"; // Configuración del editor
import { validarForm,campos } from "./helper/regex.js"; // Validaciones.

let data = [];
const admin = document.getElementById("admin"),
      noEditor = document.getElementById("formNoEditor"), // Formularios sin editor
      withEditor = document.getElementById("formWithEditor"), // Formularios con editor
      atras = document.getElementById("atras"); // Botoón atrás formularios

if(admin){
    var formulario = admin, inputs = document.querySelectorAll('#admin input');
}else if(noEditor){
    var formulario = noEditor, inputs = document.querySelectorAll('#formNoEditor input');
}else if(withEditor){
    // LLAMAR AL EDITOR
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    var formulario = withEditor, inputs = document.querySelectorAll('#formWithEditor input');
}
inputs.forEach((input) => { // VALIDAR CADA INPUT
    input.addEventListener('keyup', validarForm); // Soltar una tecla
    input.addEventListener('blur', validarForm); // Salir del input
});

const send = (route,form,checkbox,action)=>{ // MANDAR DATOS A PHP
    fetch(route,{
        method: 'POST',
        body: form
    }).then( (res) => res.text()).then( (data) => {
        if(data == "loginError"){ // DEPENDIENDO DEL RESULTADO MANDAR UNA ALERTA
            document.getElementById("error-datos").classList.add("formMensaje-active");
        }else if(data == "success"){
            window.location.href='main.php';
            localStorage.setItem("msj", "true");
        }else{
            alert(data,checkbox, action); // Llamada a función para una alerta de acuerdo al formulario
        }
    });
}
if(admin){
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        let form = new FormData(formulario), route;
        if(form.get("table") === "login" || form.get("table") === "checkInAdmin"){
            data = [campos.nombre,campos.password]; // GUARDAR EN ARREGLO LOS VALORES DE LOS CAMPOS
            route = "receivedData.php"; // DEFINIR RUTA A MANDAR LOS DATOS DEL FORMULARIO
        }
        let result = data.filter(f => f === false);
        if(result.length=== 0){ // VALIDAR SI LOS VALORES EN EN EL ARREGLO SON VERDADEROS
            document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
            send("receivedData.php",form); // LLAMAR FUNCIÓN QUE MANDA FORM A PHP
        }else{
            document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
        }
    });
}else if(noEditor){ // FORMULARIO SIN EDITOR
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        let form = new FormData(formulario);
        if(form.get("table") === "galeria"){
            data = [campos.nom_foto,campos.descripcion,campos.archivo,true,true,true];
        }else if(form.get("table") === "documento"){
            data = [campos.nombre,campos.descripcion,campos.archivo,true,true,true];
        }else if(form.get("table") === "categoria"){
            data = [campos.categoria,true,true,true,true,true];
        }else if(form.get("table") === "directorio"){
            data = [campos.nombre,campos.url,campos.estado,campos.carrera,campos.email,campos.telefono];
        }
        if(form.get("table") === "imageNews"){ // FORMULARIO PARA SELECCIONAR IMAGENES A UNA NOTICIA
            let checks = document.querySelectorAll(".check_foto"), checkbox = []; ; // OBTENER checkboxs POR SU CLASE
            checks.forEach((el) => {
                if(el.checked == true) checkbox.push(el.value);  // GUARDAR checkboxs SELECCIONADOS EN UN ARREGLO
            });

            if(checkbox.length === 0){ // SI NO SE SELECCIONA NADA MANDAR UNA ALERTA
                alert("anyImageNews",0, "add");
            }else{
                form.append("id_foto[]", checkbox); // AÑADIR AL FORM EL ARREGLO DE checkboxs
                send("receivedData.php",form,checkbox,"add");
            }
        }else{
            let result = data.filter(f => f === false);
            if(result.length === 0){ // VALIDAR QUE TODOS LOS DATOS DEL ARREGLO SON VERDADEROS
                if(form.get("table") !== "imageNews"){
                    document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
                };
                send("receivedData.php",form,[],"add");
            }else{
                if(form.get("table") === "imageNews") return;
                document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
            }
        }
    });
}else if(withEditor){ // FORMULARIO CON EDITOR
    formulario.addEventListener('submit',(e) => {
        e.preventDefault();
        document.getElementById("texto").value = quill.container.firstChild.innerHTML; // MANDAMOS EL TEXTO DEL editor AL INPUT
        let form = new FormData(formulario);
        let cuerpo = true;
        if(form.get("table") == "noticia"){
            data = [campos.titulo,campos.descripcion,cuerpo];
        }
        let result = data.filter(f => f === false);
        if(result.length === 0){
            send("receivedData.php",form,[],"add");
        }else{
            document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
        }
    });
}

if(atras){ // Evento al seleccionar botón de atrás
    atras.addEventListener("click", (e) => {
        e.preventDefault();
        window.history.back();
    })
}