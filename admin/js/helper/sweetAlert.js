// ALERTAS QUE SE VAN A USAR Y FUNCIONES QUE LOS LLAMAN
function alertInsert(previous,title,text,icon) { // ALERTA AL INSERTAR UN REGISTRO
    Swal.fire({
        title,
        text,
        icon,
        confirmButtonColor: '#47874a',
        confirmButtonText: "Aceptar",
        allowOutsideClick: false,
        showCloseButton: true
    }).then((button)=>{
        if(button.isConfirmed === true){
            location.href=`${previous}`;
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
        if(button.isDismissed === true) return;
    });
}
function confirmQuestion(previous,title,text,form){ // ALERTA PARA CONFIRMAR UNA ACCIÓN
    let route;
    if(form.get("table") === "imageNews" || form.get("table") === "imageNewsUp"){
        route = "receivedData.php";
    }else{
        route = "CRUD/delete/receivedData.php";
    }
    Swal.fire({
        title,
        text,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        confirmButtonColor: "#D13513",
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((button)=>{
        if(button.isConfirmed === true){
            fetch(route,{
                method: 'POST',
                body: form
            }).then( (res) => res.text()).then( (data) => {
                console.log(data);
                if(data === "occupied"){
                    alertInsert(`${previous}`, "No se puede eliminar", "No se puede eliminar este registro porque está enlazada a otro.", "error");
                }else if(data === "deleted"){
                    alertInsert(`${previous}`, "Eliminación exitosa", "La eliminación del registro se ha realizado exitosamente", "success");
                }else if(data === "error"){
                    alertInsert(`${previous}`, "Error", "Algo ha salido mal", "error");
                }else if(data.includes("successImageNews")){
                    alertInsert(`${previous}`, "Correcto", "Se han guardado los cambios", "success");
                }
            });
        }     
        if(button.isDismissed === true) return;
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
            location.href="../../main.php?p=noticias";
        }
    });
}

function alert(data,checkbox,action){ // FUNCIÓN QUE LLAMA LAS ALERTAS DEPENDIENDO DE LO QUE SE NECESITA.
    let msgSuccess, msgError, msgNews, title;
    if(action === "add"){ // EN PROCESO DE DEDESARROLLO
        msgNews = `Se ${(checkbox.length === 1) ? "ha" : "han"} agregado ${checkbox.length} ${(checkbox.length === 1) ? "imágen" : "imágenes"} a la noticia`;
        title = "Registro Exitoso";
        msgSuccess = `agregado`;
        msgError = `agregar `;
    }else if(action === "mod"){
        title = "Actualización Exitoso";
        msgSuccess = `actualizado`;
        msgError = `actualizar `;
    }
    switch (data) { // RECIBE LOS VALORES QUE DEVUELVE PHP AL HACER UN REGISTRO, DEPENDIENDO DE ESO SE LLAMA UNA ALERTA
        case "successGal":
            alertInsert("../../main",`${title}`, `La imágen se ha ${msgSuccess} correctamente`, "success");
            break;
        case "errorGal":
            alertInsert("../../main", "Error", `No se ha podido ${msgError} la imágen a la galeria`, "error");
            break;
        case "successDoc":
            alertInsert("../../documentos",`${title}`, `El documento se ha ${msgSuccess} correctamente`, "success");
            break;
        case "errorDoc":
            alertInsert("../../documentos", "Error", "No se ha podido insertar el documento", "error");
            break;
        case "successDir":
            alertInsert("../../directorio",`${title}`, `La UT se ha ${msgSuccess} al directorio`, "success");
            break;
        case "errorDir":
            alertInsert("../../directorio", "Error", "No se ha podido insertar la UTT en el directorio", "error");
            break;
        case "successCat":
            alertInsert("../../categoria",`${title}`, `La categoria se ha ${msgSuccess}`, "success");
            break;
        case "errorCat":
            alertInsert("../../categoria", "Error", "No se ha podido insertar la categoria", "error");
            break;
        case "errorNews":
            alertInsert("../../noticias", "Error", "No se ha podido insertar la noticia", "error");
            break;
        case "errorImageNews":
            alertInsert("../../noticias", "Error", "No se han podido eliminar las imágenes", "error");
            break;
        case "anyImageNews":
            alertQuestion("../../noticias", "Imágen no seleccionado", "No ha seleccionado ninguna imagén, ¿Quiere continuar?");
            break;
        case "equal":
            alertQuestion("../../noticias", "Sin cambios", "No ha realizado ningúna modificación, ¿Quiere continuar?");
            break;
        case "exists":
            alertInsert("index.php", "Error", "Ya existe un administrador en la Base de Datos", "error");
            break;
        case "rExits":
            alertInsert("#", "Datos repetidos", "Contenido de algún campo repetido, verifique la información que colocó, no es posible tener dos registros con la misma información", "error");
            break;
        case "errorLogin":
            alertInsert("#", "Error", "No se pudo registrar al Administrador", "error");
            break;
        case "successLogin":
            alertInsert("index.php", "Administrador registrado", "Registro correcto, por favor inicie sesión a continuación", "success");
            break;
        case "successPassword":
            alertInsert("../../documentos", `${title}`, `La contraseña para documentos privados se ha ${msgSuccess} correctamente.`, "success");
            break;
        case "errorPassword":
            alertInsert("../../documentos", "Registro incorrecto", "La contraseña se no se pudo registrar a la base de datoss", "error");
            break;
        case "errTable":
            // alertInsert("#", "Error", "Parece que modificaste el indentificador del formulario", "error");
            location.reload();
            break;
        case "errSelect":
            // alertInsert("#", "Error", "No es posible agregar el documento, la privacidad debe coincidir con un valor de la Base de Datos", "error");
            location.reload();
            break;
        default:
            break;
    }
    if(data === "successNewsUp"){
        alertInsert("../../noticias", `${title}`, `La noticia de ha ${msgSuccess} correctamente`, "success");
    }else if(data.includes("successNews")){ // ALERTA ESPECIAL PARA NOTICIAS // Registro exitoso
        let regex = /(\d+)/g;
        alertNews(`addImageNews.php?id_noticia=${data.match(regex)[0]}`);
    }
    if(data.includes("successImageNews")){ // ALERTA ESPECIAL PARA SELECCIONAR IMAGENES A LA NOTICIA
        if(action === "add"){
            console.log(msgNews);
            alertInsert("../../noticias", "Registro exitoso", `${msgNews}`);
        }
    }
}
export{
    alert,
    confirmQuestion
}

// ---------------- VALIDACIÓN PHP - CREATE --------------------------------
// echo '<script type="text/javascript">
// Swal.fire({
//     title: "Error",
//     text: "Por favor rellene el formulario correctamente",
//     icon: "error",
//     confirmButtonColor: "#D13513",
//     confirmButtonText: "Aceptar",
//     allowOutsideClick: false
// }).then((button)=>{
//     if(button.isConfirmed === true){
//         location.href = "createGalery.php"
//     }
// });
// </script>';