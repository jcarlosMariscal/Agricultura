// VALIDACIÓN DE FORMULARIOS
const inputFile = document.querySelector("#archivo"), // ID DE INPUT FILE PARA VALIDACIÓN
    boton = document.getElementById("button");

const expresiones = { // REGEX, SE MANDA A LLAMAR DE ACUERDO AL CAMPO A VALIDAR
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,60}$/, // password: /^.{1,}$/, 
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/,// Mínimo ocho caracteres, al menos una letra mayúscula, una letra minúscula y un número          
	descripcion: /^\¿?\¡?[\wÀ-ÿ\s(\#\@\$\%\&\(\)\.\,)]{5,255}\??\!?$/,
    nombre100: /^\¿?\¡?[\wÀ-ÿ\s(\#\@\$\%\&\(\))\.\,]{5,100}\??\!?$/,
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/,
    url: /^https?:\/\/[\w\-]+(\.[\w\-]+)+[\#?]?.*$/    
}
const campos = { // OBJETO QUE GUARDA EL ESTADO DE LOS CAMPOS, SE MANDA A LLAMAR PARA ACTUALIZARLO DE ACUERDO A LA VALIDACIÓN.
    nombre: false,
    password: false,
    nom_foto: false,
    descripcion: false,
    archivo: false,
    titulo: false,
    categoria: false,
    email: false,
    telefono: false,
    url: false
}

const validarInputFile = (input) => { // MÉTODO QUE VALIDA UN INPUT FILE
    if(!inputFile.files[0]) {
        document.querySelector(`#group-archivo .formInputError`).classList.add("formInputError-active");
        return;
    };
    var filename = inputFile.files[0].name;
    var exten = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
    var extensiones = [];
    if(input.accept === "image/png, .jpeg, .jpg, image/gif"){
        extensiones = ["png","PNG","jpeg","jpg","gif"]; // ESTABLECER IMÁGENES ADMITIDOS
    }else if(input.accept === ".pdf"){
        extensiones= ["pdf"];
    }
    
    if(extensiones.find(el => el === exten)){ // LA VALIDACIÓN ES CORRECTA
        document.getElementById(`group-archivo`).classList.remove("form-incorrecto");
        document.querySelector(`#group-archivo .formInputError`).classList.remove("formInputError-active");
        document.getElementById(`group-archivo`).classList.add("form-success-file");
        boton.classList.remove("disabled-button");
        campos['archivo'] = true;
    }else{ // LA VALIDACIÓN ES INCORRECTA
        document.getElementById(`group-archivo`).classList.remove("form-success-file");
        document.querySelector(`#group-archivo .formInputError`).classList.add("formInputError-active");
        document.getElementById('inputFile').innerHTML = "La extension " + exten + " no está permitido. Seleccione una imagen.";
        boton.classList.add("disabled-button");
        campos['archivo'] = false;
    }
}

const validarCampo = (expresion, input, campo) => { // MÉTODO PARA VALIDAR INPUTS EN GENERAL
    if(expresion.test(input.value)){// SI LA VALIDACIÓN ES CORRECTA
        document.getElementById(`group-${campo}`).classList.remove("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.add("form-success");
        document.querySelector(`#group-${campo} .formInputError`).classList.remove("formInputError-active");
        boton.classList.remove("disabled-button");
        campos[campo] = true; // CAMBIAMOS EL VALOR DEL CAMPO A TRUE
    }else{ // SI LA VALIDACIÓN ES INCORRECTA
        document.getElementById(`group-${campo}`).classList.add("form-incorrecto");
        document.getElementById(`group-${campo}`).classList.remove("form-success");
        document.querySelector(`#group-${campo} .formInputError`).classList.add("formInputError-active");
        boton.classList.add("disabled-button");
        campos[campo] = false; // CAMBIAMOS EL VALOR DEL CAMPO A FALSE
    }
}

const validarForm = (e) => {
    switch (e.target.name){
        case "archivo": // VALIDAR INPUT FILE
            validarInputFile(e.target);
        break;
        case "nombre": // Directorio
            if((e.target.placeholder).includes("documento")){ // HACER VALIDACIÓN PARA DOCUMENTO
                validarCampo(expresiones.nombre100, e.target, 'nombre'); // TIENE EL MISMO ID ('nombre') PERO USA OTRA REGEX PORQUE ES NECESARIO
            }
            validarCampo(expresiones.nombre, e.target, 'nombre');
        break;
        case "password":
            validarCampo(expresiones.password, e.target, 'password');
        break;
        case "nom_foto":
            validarCampo(expresiones.nombre, e.target, 'nom_foto');
        break;
        case "descripcion":
            validarCampo(expresiones.descripcion, e.target, 'descripcion');
        break;
        case "titulo":
            validarCampo(expresiones.nombre100, e.target, 'titulo');
        break;
        case "categoria":
            validarCampo(expresiones.nombre100, e.target, 'categoria');
        break;
        case "url": // Directorio
            validarCampo(expresiones.url, e.target, 'url');
        break;
        case "estado":
            validarCampo(expresiones.nombre100, e.target, 'estado');
        break;
        case "carrera":
            validarCampo(expresiones.nombre100, e.target, 'carrera');
        break;
        case "email":
            validarCampo(expresiones.email, e.target, 'email');
        break;
        case "telefono":
            validarCampo(expresiones.telefono, e.target, 'telefono');
        break;
    }
}
export{
    campos,
    validarForm
}