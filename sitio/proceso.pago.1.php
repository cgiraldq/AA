<? include ("sessiones.php");
if ($_REQUEST['regreso']=="1") {
  $mensaje="LA TRANSACCION FUE CANCELADA.";
  $mensaje.=" la transaccion fue cancelada por usted.  ";
  $mensaje.=" Por favor cambie la forma de pago, actualice el transporte y realicela nuevamente.";
}
if ($_REQUEST['regreso']=="2") {
  $mensaje="LA TRANSACCION FUE RECUPERADA.";
  $mensaje.=" la transaccion fue recuperada por usted.  ";
  $mensaje.=" Por favor cambie la forma de pago, actualice el transporte y realicela nuevamente.";
}

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
    <?include("incluidos_sitio/head/head.php");?>

    <body onload="paisesorigen();">

        <section class="cont_pagina">

            <section class="cont_header">
              <?include("incluidos_sitio/header/header.php");?>
            </section>

                <?include("incluidos_sitio/menu/menu.superior.php");?>
            <section class="bg_cuerpo">
              <section class="cont_cuerpo_general">

                  <?include("incluidos_sitio/ecommerce/carrito/proceso.pago.1.php");?>
              </section>

              </section>
            </section>

            <section class="cont_footer">
                <?include("incluidos_sitio/footer/footer.php");?>
            </section>

    </body>
</html>
<script language="javascript">

function cargar_ciudades_registro(){

        conexion51=AjaxObj()

        contenedorx="cargar_ciudadesd";

          // alert("entra");

    //  var valor=document.getElementById('idpaisdestino').value;

        var valor=2;

       // alert(valor);

        conexion51.open("POST","modulos/transporte/wcw/cargar.ciudades.php?campodata=cargar_ciudades&param="+valor,true);



        conexion51.onreadystatechange =function() {



        //alert(conexion51.readyState);

             if (conexion51.readyState==4) {



             var _resultado = conexion51.responseText;

             if (_resultado !="0" && _resultado !="-1" && _resultado !="") {

            contenedorx=document.getElementById(contenedorx);

            contenedorx.innerHTML = _resultado;

                //alert();

             }

               // fin resultado

        } // fin conexion51

      } // fin funcion conexion51 interna

      conexion51.send(null) // limpia conexion



}

function cargar_ciudades_registro_origen(){

        conexion52=AjaxObj()

        contenedorx="idciudadorigen";

         //  alert("entra");

    //  var valor=document.getElementById('idpaisdestino').value;

       // var valor=document.forma_carrito.idpaisorigen.value;


        var  valor=2;
       // alert(valor);

        conexion52.open("POST","modulos/transporte/wcw/cargar.ciudades.origen.php?campodata=cargar_ciudades&param="+valor,true);



        conexion52.onreadystatechange =function() {



        //alert(conexion52.readyState);

             if (conexion52.readyState==4) {



             var _resultado = conexion52.responseText;



             if (_resultado !="0" && _resultado !="-1" && _resultado !="") {

            contenedorx=document.getElementById(contenedorx);

            contenedorx.innerHTML = _resultado;


             }

               // fin resultado

        } // fin conexion52

      } // fin funcion conexion52 interna

      conexion52.send(null) // limpia conexion



}


       function paisesorigen(){

        conexion=AjaxObj()

        contenedor="idpaisorigen";

        //alert("paises");





        conexion.open("POST","modulos/transporte/wcw/cargar.paises.origen.php",true);



        conexion.onreadystatechange =function() {



        //          alert(conexion.readyState);

             if (conexion.readyState==4) {



             var _resultado = conexion.responseText;

             if (_resultado !="0" && _resultado !="-1" && _resultado !="") {

            if (contenedor){

            contenedor=document.getElementById(contenedor);

            contenedor.innerHTML = _resultado;

                //alert("entra");

             }



             }

               // fin resultado

        } // fin conexion

      } // fin funcion conexion interna

      conexion.send(null) // limpia conexion


}


  function paises(){

        conexion1=AjaxObj()

        contenedor1="idpaisdestino";

        //alert("paises");





        conexion1.open("POST","modulos/transporte/wcw/cargar.paises.php",true);



        conexion1.onreadystatechange =function() {



        //          alert(conexion1.readyState);

             if (conexion1.readyState==4) {



             var _resultado = conexion1.responseText;

             if (_resultado !="0" && _resultado !="-1" && _resultado !="") {

            if (contenedor1){

            contenedor1=document.getElementById(contenedor1);

            alert(contenedor1);

            contenedor1.innerHTML = _resultado;

                //alert("entra");

             }



             }

               // fin resultado

        } // fin conexion1

      } // fin funcion conexion1 interna

      conexion1.send(null) // limpia conexion1


}

</script>
