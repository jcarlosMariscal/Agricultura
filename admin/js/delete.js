// ------------ ELIMINAR REGISTROS --------------------------
import { confirmQuestion } from "./helper/sweetAlert.js";
let form = new FormData();
// Evento al seleccionar botón para eliminar, lo obtenemos con su selector.
const on =(element, event,selector,handler) => {
    element.addEventListener(event, (e) => {
        if(e.target.closest(selector)){
            handler(e);
        }
    })
}
// Retorna un objeto, que tiene información del nodo padre del elemento presionado.
const data = (d) => {
    const fila = d.target.parentNode.parentNode;
    return {
        id: fila.firstElementChild.innerHTML,
        nombre: fila.firstElementChild.nextElementSibling.innerHTML,
        UT:fila.firstElementChild.nextElementSibling
    }
}
// Usamos la función para mandar el evento, obtemos los datos y mandamos una alerta de confirmación antes de eliminar.
on(document,'click','.deleteGal',(e) => {
    const obData = data(e);
    form.append('table','galeria');
    form.append("id",obData.id);
    let msgNews = `¿Está seguro de eliminar esta imagen (${obData.nombre}) de la galeria?`;  
    confirmQuestion("main.php", "Eliminar imágen", `${msgNews}`, form);
});
on(document,'click','.deleteDoc',(e) => {
    const obData = data(e);
    form.append('table','documento');
    form.append("id",obData.id);
    let msgNews = `¿Está seguro de eliminar este documento (${obData.nombre}) de la Base de Datos?`;  
    confirmQuestion("main.php?p=documentos", "Eliminar Documento", `${msgNews}`, form);
});
on(document,'click','.deleteCat',(e) => {
    const obData = data(e);
    form.append('table','categoria');
    form.append("id",obData.id);
    let msgNews = `¿Está seguro de eliminar esta categoria (${obData.nombre}) de la Base de Datos?`;  
    confirmQuestion("main.php?p=categoria", "Eliminar Categoria", `${msgNews}`, form);
});
on(document,'click','.deleteDir',(e) => {
    const obData = data(e);
    form.append('table','directorio');
    form.append("id",obData.id);
    let msgNews = `¿Está seguro de eliminar ${obData.UT.firstElementChild.innerHTML} de la Base de Datos?`;  
    confirmQuestion("main.php?p=directorio", "Eliminar Universidad del Directorio", `${msgNews}`, form);
});
on(document,'click','.deleteNews',(e) => {
    const obData = data(e);
    form.append('table','noticia');
    form.append("id",obData.id);
    let msgNews = `¿Está seguro de eliminar la noticia ${obData.nombre} de la Base de Datos?. Si tiene imágenes relacionadas estas no se eliminarán.`;  
    confirmQuestion("main.php?p=noticias", "Eliminar Noticia", `${msgNews}`, form);
});