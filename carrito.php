<?php
    session_start(); 
    if (!isset($_SESSION['codusu'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<head>
    <title>Sistema Ecommerce</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <link href="fontawesome-free-5.15.2-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="header-content">
        <div class="logo-place"><a href="index.php"><img src="assets/fruverco.png" alt=""></a></div>
        <div class="search-place">
            <input type="text" id="idbusqueda" class="idbusqueda-text" placeholder="¿Qué quieres comer hoy?">
            <button class="btn-main btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="option-place">
        <?php
                    if(isset($_SESSION['codusu'])){
                        echo '<div class="item-option"><i class="fas fa-user-circle" aria-hidden="true"></i><p>'.$_SESSION['nomusu'].'</p></div>';
                    }else{
                ?>
                <div class="item-option" title="Registrarme"><i class="fas fa-user-plus" aria-hidden="true"></i></div>
                <div class="item-option" title="Ingresar"><i class="fas fa-sign-in-alt" aria-hidden="false"></i></div>
                <?php
                }
                ?>
                <div class="item-option" title="Mis productos">
                    <a href="pedidos.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i></a>
                </div>
        </div>
    </header>
    <div class="main-content">
        <div class="content-page">
            <h3>Mi Carrito</h3>
            <div class="body-pedido" id="space-list">
            </div>
            <input class="input-procesar_compra"type="text" id="dirusu" placeholder="Dirección">
            <br>
            <input class="input-procesar_compra"type="text" id="telusu" placeholder="Telefono">
            <br>
            <button onclick="procesar_compra()">Procesar Compra</button>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url:'servicios/pedido/get_proprocesar.php',
                type:'POST',
                data:{},
                success:function(data){
                    console.log(data);
                    let html='';
                    for(var i=0; i < data.datos.length; i++){
                        html+=
                        '<div class="item-pedido">'+
                            '<div class="pedido-img">'+
                                '<img src="assets/'+data.datos[i].rutimapro+'">'+
                            '</div>'+
                            '<div class="pedido-detalle">'+
                                '<h3>'+data.datos[i].nompro+'</h3>'+
                                '<p><b>Precio:</b> $/'+data.datos[i].prepro+'</p>'+
                                '<p><b>Fecha:</b>'+data.datos[i].fecped+'</p>'+
                                '<p><b>Estado:</b>'+data.datos[i].estado+'</p>'+
                                '<p><b>Dirección:</b>'+data.datos[i].dirusuped+'</p>'+
                                '<p><b>Teléfono:</b>'+data.datos[i].telusuped+'</p>'+
                            '</div>'+
                        '</div>';
                    }
                    document.getElementById("space-list").innerHTML=html;
                },
                error:function(err){
                    console.error(err);
                }
            });
        });

        function procesar_compra(){
            let dirusu=document.getElementById("dirusu").value;
            let telusu=$("#telusu").val();
            if((dirusu=="") || (telusu=="")){ //tener cuidado con la escritura del OR logico dentro del if
                alert("Complete los campos para poder procesar su compra");
            }else{
                $.ajax({
                url:'servicios/pedido/confirm.php',
                type:'POST',
                data:{
                    dirusu:dirusu,
                    telusu:telusu
                },
                success:function(data){
                    console.log(data);
                    if(data.state){
                        window.location.href="pedido.php";
                    }else{
                        alert(data.detail);
                    }
                },
                error:function(err){
                    console.error(err);
                }
            });
            }
        }
    </script> 
</body>
</html>