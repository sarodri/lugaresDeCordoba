// AJAX con jQuery para utilizar filtros de categorias, con Bootstrap 5 usamos JS puro.


(function($){
    console.log('Hola WordPress');
   
    $("select").change(function(e){ 
        e.preventDefault();
        $.ajax({
            url: lg.ajaxurl,
            method: "POST",
            data: {
                "action": "lgFiltroLugares",
                "categoria": $(this).find(":selected").val()
            },
            beforeSend: function () {
                $("#resultado-lugares").html("Cargando...")
            },
            success: function(data){
                let html = "";
                data.forEach(item => {
                    html += `<div class="col-md-4 col-12 my-3">
                    <figure>${item.imagen}</figure>
                    <h4 class="my-2">
                        <a href="${item.link}">${item.titulo}</a>
                    </h4>
                </div>`;
                })
                $("#resultado-lugares").html(html);
            },
            error: function (error){
                console.log(error)
            },
        })
    })

$(document).ready(function(){
            $.ajax({
                url:lg.apiurl+"noticias/3",
                method: "GET",
    
                beforeSend: function () {
                    $("#resultado-noticias").html("Cargando...");
                },
                success: function(data){
                    let html = "";
                    data.forEach(item => {
                        html += `<div class="col-md-4 col-12 my-3" id="sec-noticias">
                    <figure>${item.imagen}</figure>
                    <h4 class="my-2">
                        <a href="${item.link}">${item.titulo}</a>
                    </h4>
                </div>`;                   })
                    $("#resultado-noticias").html(html);
                },
                error: function (error){
                    console.log(error)
                },
            })
        })
})(jQuery);


// Para ejecutar con Fetch
// let selectField = document.getElementById("lugares-realcionados");
// let renderContainer = document.getElementById("resultado");
// if (selectField) {
//     selectField.addEventListener("change", function(e){
//         e.preventDefault();

//         let info = new FormData();
//         info.append("action", "lgFiltroLugares");
//         info.append("categoria", selectField.options[selectField.selectedIndex].value);

//         let data = new URLSearchParams(info);
//         fetch(
//             lg.ajaxurl,
//             {
//                 method: 'POST',
//                 body: data
//             }
//         )
//         .then(res => res.json())
//         .catch(error => {
//             console.log(error);
//         })
//         .then(data => {
//             let html = "";
//             data.forEach(item => {
//                 html += `<div class="col-md-4 col-12 my-3">
//                     <figure>${item.imagen}</figure>
//                     <h4 class="my-2">
//                         <a href="${item.link}">${item.titulo}</a>
//                     </h4>
//                 </div>`;
//             })
//             renderContainer.append(html);
//         })
//     })
// }