// VALIDACIÓN DE FORMULARIOS PARA AGREGAR REGISTROS
import { alert } from "./sweetAlert.js"; // Archivo con alertas
import { toolbarOptions } from "./optionsEditor.js"; // Configuración del editor
import { validarForm,campos } from "./regex.js"; // Módulo que se encarga de las validaciones.

const admin = document.getElementById("admin");// Formularios administrador
const noEditor = document.getElementById("formNoEditor"); // Formularios sin editor
const withEditor = document.getElementById("formWithEditor"); // Formularios con editor
const button = document.getElementById("button");
const arrayTrue = (el) => el = true;
let data = [];

if(admin){
    var formulario = admin;
    var inputs = document.querySelectorAll('#admin input');
}else if(noEditor){
    var formulario = noEditor;
    var inputs = document.querySelectorAll('#formNoEditor input');
}else if(withEditor){
    // LLAMAR AL EDITOR
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    var formulario = withEditor;
    var inputs = document.querySelectorAll('#formWithEditor input');
}
// VALIDAR CADA INPUT
inputs.forEach((input) => { 
    input.addEventListener('keyup', validarForm);
    input.addEventListener('blur', validarForm);
});

if(admin){
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();

        // GUARDAR CAMPOS DE FORMULARIOS Y SUS VALORES PARA MANDAR A PHP
        let form = new FormData(formulario);
        let route;
        if(form.get("table") === "login"){
            data = [campos.nombre,campos.password]; // GUARDAR EN ARREGLO LOS VALORES DE LOS CAMPOS
            route = "admin/receivedData.php"; // DEFINIR RUTA A MANDAR LOS DATOS DEL FORMULARIO
        }
        if(form.get("table") === "checkInAdmin"){
            data = [campos.nombre,campos.password];
            route = "receivedData.php"
        }
        if(data.every(arrayTrue)){ // VALIDAR SI LOS VALORES EN EN EL ARREGLO SON VERDADEROS
            document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
            fetch(route,{
                method: 'POST', // MANDAR LOS DATOS POR POST
                body: form
            }).then( (res) => res.text()).then( (data) => {
                // console.log(data);
                if(data == "loginError"){ // DEPENDIENDO DEL RESULTADO MANDAR UNA ALERTA
                    document.getElementById("error-datos").classList.add("formMensaje-active");
                }else if(data === "exists"){
                    alert(data);
                }else if(data === "errorLogin"){
                    alert(data);
                }else if(data == "success"){
                    window.location.href='admin/main.php';
                    localStorage.setItem("msj", "true");
                }else if(data === "successLogin"){
                    alert(data);
                }
            });
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
            let checks = document.querySelectorAll(".check_foto"); // OBTENER checkboxs POR SU CLASE
            let checkbox = [];
            checks.forEach((el) => {
                if(el.checked == true){ // GUARDAR checkboxs SELECCIONADOS EN UN ARREGLO
                    checkbox.push(el.value); 
                }
            });
            if(checkbox.length === 0){ // SI NO SE SELECCIONA NADA MANDAR UNA ALERTA
                alertQuestion("../main.php")
            }
            form.append("id_foto[]", checkbox); // AÑADIR AL FORM EL ARREGLO DE checkboxs
            fetch("receivedData.php",{
                method: 'POST', // MANDAR LOS DATOS POR POST
                body: form
            }).then( (res) => res.text()).then( (data) => {
                alert(data,checkbox, "add"); // LLAMAR AL MÓDULO DE LAS ALERTAS (Falta refactorizar el código de Admin)
            });
        }
        if(data.every(arrayTrue)){ // VALIDAR QUE TODOS LOS DATOS DEL ARREGLO SON VERDADEROS
            if(form.get("table") !== "imageNews"){
                document.getElementById('formulario-mensaje').classList.remove('formMensaje-active');
            };
            fetch("receivedData.php",{
                method: 'POST',
                body: form
            }).then( (res) => res.text()).then( (data) => {
                alert(data,0,"add"); //LLAMAR AL MÓDULO DE LAS ALERTAS
            });
        }else{
            if(form.get("table") === "imageNews") return;
            document.getElementById('formulario-mensaje').classList.add('formMensaje-active');
        }
    });
}else if(withEditor){ // FORMULARIO CON EDITOR
    formulario.addEventListener('submit',(e) => {
        e.preventDefault();
        let form = new FormData(formulario);
        document.getElementById("texto").value = quill.container.firstChild.innerHTML; // MANDAMOS EL TEXTO DEL editor AL INPUT
        let cuerpo = false;
        let textCuerpo = document.getElementById("texto").value;
        // VALIDAR EL EDITOR
        if(textCuerpo === "<p><br></p>" || textCuerpo == "<p><br></p><p><br></p>" || textCuerpo == "<p><br></p><p><br></p><p><br></p>"){
            document.getElementById(`group-text`).classList.add("form-incorrecto");
            document.querySelector(`#group-text .formInputError`).classList.add("formInputError-active");
            cuerpo = false;
        }else{
            cuerpo = true;
        }
        if(form.get("table") == "noticia"){
            data = [campos.titulo,campos.descripcion,cuerpo];
        }
        if(data.every(arrayTrue)){
            fetch('receivedData.php',{
                method: 'POST',
                body: form
            }).then( (res) => res.text()).then( (data) => {
                alert(data,0,"add");
            });
        }else{
            document.getElementById('formulario-mensaje').classList.add('formOneMensaje-active');
        }
    });
}