// VALIDACIÓN DE FORMULARIOS PARA ACTUALIZAR REGISTRO
import { alert, confirmQuestion } from "./sweetAlert.js";
import { toolbarOptions } from "./optionsEditor.js";
import { validarForm,campos } from "./regex.js";

const admin = document.getElementById("admin");
const noEditor = document.getElementById("formNoEditor");
const withEditor = document.getElementById("formWithEditor");

const arrayTrue = (el) => el = true;
let data = [];

if(admin){
    var formulario = admin;
    var inputs = document.querySelectorAll('#admin input'); // Obtener todos los inputs.
}else if(noEditor){
    var formulario = noEditor;
    var inputs = document.querySelectorAll('#formNoEditor input');
}else if(withEditor){
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    var formulario = withEditor;
    var inputs = document.querySelectorAll('#formWithEditor input');
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarForm);
    input.addEventListener('blur', validarForm);
});

if(noEditor){
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        let form = new FormData(formulario);
        if(form.get("table") === "imageNews"){
            let checks = document.querySelectorAll(".check_foto");
            let checkbox = [];
            checks.forEach((el) => {
                if(el.checked == true){
                    checkbox.push(el.value);
                }
            });
            let $total = document.getElementById("total").value;
            if(checkbox.length === 0){
                alert("anyImageNews",0, "add");
            }else if(checkbox.length == $total.toString()){ // SI NO HUBO CAMBIOS EN LA SELECCIÓN MANDAR UNA ELERTA
                alert("equal",0,"add");  
            }else{
                form.append("id_foto[]", checkbox);
                let msgNews = `Ahora esta noticia tendrá ${checkbox.length} imágenes, ¿Quiere continuar con la eliminación?`;  
                // SE MANDARÁN LOS DATOS A PHP DESDE LA ALERTA  
                confirmQuestion("../main.php?p=noticias", "Guardar cambios", `${msgNews}`, form); // MANDAR ALERTA DE CONFIRMACIÓN DE CAMBIOS
            }
        }
    });
}