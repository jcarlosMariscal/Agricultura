// ALERTAS QUE SE VAN A USAR Y FUNCIONES QUE LOS LLAMAN
function alertInsert(previous,title,text,icon) { // ALERTA AL INSERTAR UN REGISTRO
    Swal.fire({
        title,
        text,
        icon,
        confirmButtonColor: '#47874a',
        confirmButtonText: "Aceptar",
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
            location.href=`${previous}`;;
        }
    });
}
function alertQuestion(previous,title,text){ // ALERTA PARA PREGUNTAR AL ADMINISTRADOR
    Swal.fire({
        title,
        text,
        icon: "question",
        showConfirmButton: false,
        showCancelButton: true,
        showDenyButton: true,
        denyButtonText: 'Confirmar',
        denyButtonColor: '#47874a',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isDenied === true){
            location.href=`${previous}`;
        }
        if(button.isDismissed === true){
            return;
        }
    });
}
function confirmQuestion(previous,title,text,form){ // ALERTA PARA CONFIRMAR UNA ACCIÓN
    Swal.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
            fetch("receivedData.php",{
                method: 'POST',
                body: form
            }).then( (res) => res.text()).then( (data) => {
                // console.log(data);
                location.href=`${previous}`;
            });
                
        }     
        
        if(button.isDismissed === true){
            location.href=`${previous}`;
            
        }
    });
}
function alertNews(pageAdd){ // ALERTA ESPECIAL PARA INSERTAR NOTICIAS
    Swal.fire({
        title: "Registro exitoso",
        text: "La noticia se ha insertado correctamente. ¿Quiere agregar una imágen para la noticia ahora o después?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Agregar",
        confirmButtonColor: "#47874a",
        cancelButtonText: 'Después',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
            location.href=`${pageAdd}`;
        }
        if(button.isDismissed === true){
            location.href="../main.php?p=noticias";
        }
    });
}

function alert(data,checkbox,action){ // FUNCIÓN QUE LLAMA LAS ALERTAS DEPENDIENDO DE LO QUE SE NECESITA.
    let msgNews;
    if(action === "add"){ // EN PROCESO DE DEDESARROLLO
        msgNews = `Se ${(checkbox.length === 1) ? "ha" : "han"} agregado ${checkbox.length} ${(checkbox.length === 1) ? "imágen" : "imágenes"} a la noticia`;
    }
    switch (data) { // RECIBE LOS VALORES QUE DEVUELVE PHP AL HACER UN REGISTRO, DEPENDIENDO DE ESO SE LLAMA UNA ALERTA
        case "successGal":
            alertInsert("../main.php","Registro exitoso", "Se insertó correctamente la imágen a la galeria", "success");
            break;
        case "errorGal":
            alertInsert("../main.php", "Error", "No se ha podido insertar la imágen en la galeria", "error");
            break;
        case "successDoc":
            alertInsert("../main.php?p=documentos","Registro exitoso", "Se insertó correctamente el documento", "success");
            break;
        case "errorDoc":
            alertInsert("../main.php?p=documentos", "Error", "No se ha podido insertar el documento", "error");
            break;
        case "successDir":
            alertInsert("../main.php?p=directorio","Registro exitoso", "Se insertó correctamente la UTT al directorio", "success");
            break;
        case "errorDir":
            alertInsert("../main.php?p=directorio", "Error", "No se ha podido insertar la UTT en el directorio", "error");
            break;
        case "successCat":
            alertInsert("../main.php?p=categoria","Registro exitoso", "Se insertó correctamente la categoria", "success");
            break;
        case "errorCat":
            alertInsert("../main.php?p=categoria", "Error", "No se ha podido insertar la categoria", "error");
            break;
        case "errorNews":
            alertInsert("../main.php?p=noticias", "Error", "No se ha podido insertar la noticia", "error");
            break;
        case "errorImageNews":
            alertInsert("../main.php?p=noticias", "Error", "No se han podido eliminar las imágenes", "error");
            break;
        case "anyImageNews":
            alertQuestion("../main.php?p=noticias", "Imágen no seleccionado", "No ha seleccionado ninguna imagén, ¿Quiere continuar?");
            break;
        case "equal":
            alertQuestion("../main.php?p=noticias", "Sin cambios", "No ha realizado ningúna modificación, ¿Quiere continuar?");
            break;
        case "exists":
            alertInsert("../admin.php", "Error", "Ya existe un administrador en la Base de Datos", "error");
            break;
        case "errorLogin":
            alertInsert("#", "Error", "No se pudo registrar al Administrador", "error");
            break;
        case "successLogin":
            alertInsert("../admin.php", "Administrador registrado", "Registro correcto, por favor inicie sesión a continuación", "success");
            break;
        default:
            break;
    }
    if(data.includes("successNews")){ // ALERTA ESPECIAL PARA NOTICIAS
        let regex = /(\d+)/g;
        alertNews(`addImageNews.php?id_noticia=${data.match(regex)[0]}`);
    }
    if(data.includes("successImageNews")){ // ALERTA ESPECIAL PARA SELECCIONAR IMAGENES A LA NOTICIA
        if(action === "add"){
            console.log(msgNews);
            alertInsert("../main.php?p=noticias", "Registro exitoso", `${msgNews}`);
        }
    }
}
export{
    alert,
    imageNews,
    confirmQuestion
}