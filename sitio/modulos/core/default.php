<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// core central de datos
include("../../incluidos_modulos/modulos.globales.php");
$id=$_SESSION['i_idusuario'];
$titulomodulo="Principal";
//$db->debug=true;
?>

<html>

    <?include("../../incluidos_modulos/head.php");?>
  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">

<body>

      <? include("../../incluidos_modulos/navegador.principal.php");?>


    <section class="cont_izq">

      <article class="titulo_crm">
        <div class="titulo">
          <h1>ACTUALIDADES</h1>
          <h2>Administre su sitio web.</h2>
        </div>
        <div>
          <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/crm.png">
        </div>
      </article>

      <div class="titulo_correo">
        <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/msm.png">
        <h1>NOTIFICACIONES</h1>
      </div>

      <ul class="correo_notificaciones" >

          <?if(validar_core($_SESSION['i_idusuario'],75)>0){?>
          <a href="../ecommerce/compras/default.php">
          <?
          $sql="select count(*) as total from ecommerce_tblpagos ";
        $clientes=0;
        $result=$db->Execute($sql);
        if(!$result->EOF) $clientes=$result->fields[0];
        $result->Close();

          ?>  
        <li>
            <div class="circulo azul"><h1 ><? echo $clientes?></h1></div>
            <h2>PEDIDOS</h2>
        </li>
          </a>

        
        <? } ?>



          <a href="../crm/clientesregistrados/default.php">
          <?
          $sql="select count(*) as total from tblclientes ";
        $clientes=0;
        $result=$db->Execute($sql);
        if(!$result->EOF) $clientes=$result->fields[0];
        $result->Close();

          ?>  
        <li>
            <div class="circulo azul"><h1 ><? echo $clientes?></h1></div>
            <h2>CLIENTES REGISTRADOS</h2>
        </li>
          </a>
          <?
          $sql="select count(*) as total from tblcontacto ";
        $contacto=0;
        $result=$db->Execute($sql);
        if(!$result->EOF) $contacto=$result->fields[0];
        $result->Close();

          ?>  

          <a href="../crm/correos/default.php">
        <li>
            <div class="circulo rojo"><h1 ><? echo $contacto?></h1></div>
            <h2>CORREOS DE CONTACTO</h2>
        </li>
          </a>

          <a href="../crm/contactenos_corporativo/default.php">
          <?
          $sql="select count(*) as total from tblcontacto_corporativo ";
        $contactoc=0;
        $result=$db->Execute($sql);
        if(!$result->EOF) $contactoc=$result->fields[0];
        $result->Close();

          ?>  


        <li>
            <div class="circulo amarillo"><h1 ><? echo $contactoc?></h1></div>
            <h2>CORREOS DE CONTACTO CORPORATIVO</h2>
        </li>
          </a>

          <?
          $sql="select count(*) as total from tblrecomendar ";
        $recomendar=0;
        $result=$db->Execute($sql);
        if(!$result->EOF) $recomendar=$result->fields[0];
        $result->Close();

          ?>  


          <a href="../crm/recomendar/default.php">
        <li>
            <div class="circulo verde"><h1><? echo $recomendar?></h1></div>
            <h2>CORREOS DE RECOMENDACIONES</h2>
        </li>
          </a>

      </ul>

          <?if(validar_core($_SESSION['i_idusuario'],75)>0){?>




      <div class="titulo_correo">
        <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/carrito.png">
        <h1>ESTADO ACTUAL DE LOS PRODUCTOS</h1>
      </div>

          <ul class="correo_ecommerce" >
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',1,1)<>""){?>


            <?
$sinprecio1="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (precio1='' or precio1 is null or precio1=0) ";
$resultx=$db->Execute($sql);
 if (!$resultx->EOF) {
$sinprecio1=$resultx->fields[0];
}
$resultx->Close();

?>

              <a href="../ecommerce/listaproductos/default.producto.php?sinprecio=1">
            <li>
                <div class="circulo_ecommerce verde"><h1>Sin precio (Publico)</h1>

                <h2 class="verde"><? echo $sinprecio1?></h2>
                </div>
            </li>
              </a>
<? } ?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',2,1)<>""){?>
<?$sinprecio2="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (precio2='' or precio2 is null or precio2=0) ";
$resultx=$db->Execute($sql);
 if (!$resultx->EOF) {
$sinprecio2=$resultx->fields[0];
}
$resultx->Close();

?>

              <a href="../ecommerce/listaproductos/default.producto.php?sinprecio=2">
            <li>
                <div class="circulo_ecommerce rojo"><h1 >Sin precio (Mayorista)</h1>

                <h2 class="rojo"><? echo $sinprecio2?></h2>
                </div>
            </li>
              </a>
<? } ?>
<?if(seldato('dsm','idactivo','ecommerce_tblnombrecampo',3,1)<>""){?>
<?
$sinprecio="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (precio3='' or precio3 is null or precio3=0) ";
$resultx=$db->Execute($sql);
 if (!$resultx->EOF) {
$sinprecio=$resultx->fields[0];
}
$resultx->Close();
?>


              <a href="../ecommerce/listaproductos/default.producto.php?sinprecio=3">
            <li>
                <div class="circulo_ecommerce azul"><h1 >Sin precio (Precio especial)</h1>

                <h2 class="azul"><? echo $sinprecio?></h2>
                </div>
            </li>
              </a>
<? } ?>

        <?$sintrans="";
        // saber si ya esta asociado en la tabla de productos
        $sql="select count(*) as total from ecommerce_tblproductos where (dsflete='' or dsflete is null or dsflete=0) ";
        $resultx=$db->Execute($sql);
        if (!$resultx->EOF) {
        $sintrans="".$resultx->fields[0]."";
        }
        $resultx->Close();
        
        ?>


            <a href="../ecommerce/listaproductos/default.producto.php?sintrans=1">
            <li>
                <div class="circulo_ecommerce azul"><h1 >Sin valor flete</h1>

                <h2 class="azul"><? echo $sintrans?></h2>
                </div>
            </li>
              </a>

<?$siniva="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (iva='' or iva is null or iva=0) ";
$resultx=$db->Execute($sql);
if (!$resultx->EOF) {
$siniva=$resultx->fields[0];
}
$resultx->Close();
?>


              <a href="../ecommerce/listaproductos/default.producto.php?siniva=1">
            <li>
                <div class="circulo_ecommerce azul"><h1 >Sin porcentaje Impuestos</h1>

                <h2 class="azul"><? echo $siniva?></h2>
                </div>
            </li>
              </a>

                    <?
                    $sinimagen="";
                    // saber si ya esta asociado en la tabla de productos
                    $sql="SELECT count(*) as total, a.idorigen FROM ecommerce_tblproductoximg a, ecommerce_tblproductos b WHERE b.id=a.idorigen and dsimg not in ('NULL','NULLNULL') group by idorigen";
                    //echo $sql;
                    $total1=0;
                    $resultx=$db->Execute($sql);
                    if (!$resultx->EOF) {
                        while (!$resultx->EOF){
                        $total1++;
                        $resultx->Movenext();
                      }
                    }
                    $resultx->Close();

                    $resultx->Close();
                    $sql="select count(*) as total from ecommerce_tblproductos a where a.id>0";
                   // echo $sql;
                    $resultx=$db->Execute($sql);
                    if (!$resultx->EOF) {
                      $total2=$resultx->fields[0];
                      $totalfinal=$total2-$total1;
                    $sinimagen=$totalfinal;
                    }
                    $resultx->Close();
                    ?>



            <a href="../ecommerce/listaproductos/default.producto.php?sinimagen=1">
              <li>
                  <div class="circulo_ecommerce amarillo"><h1 >Sin imagen</h1>

                  <h2 class="amarillo"><? echo $sinimagen?></h2>
                  </div>
              </li>
            </a>

<?$sindesc="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (dsd='' or dsd is null) ";
$resultx=$db->Execute($sql);
if (!$resultx->EOF) {
$sindesc=$resultx->fields[0];
  }
  $resultx->Close();
?>



            <a href="../ecommerce/listaproductos/default.producto.php?sindesc=1">
              <li>
                  <div class="circulo_ecommerce verde"><h1 >Sin descripci&oacute;n corta o resumen</h1>

                  <h2 class="verde"><? echo $sindesc?></h2>
                  </div>
              </li>
            </a>

<?
$sinref="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from ecommerce_tblproductos where (dsreferencia='' or dsreferencia is null) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {
    $sinref=$resultx->fields[0];
  }
  $resultx->Close();
?>


            <a href="../ecommerce/listaproductos/default.producto.php?sinref=1">
              <li>
                  <div class="circulo_ecommerce rojo"><h1 >Sin referencia</h1>

                  <h2 class="rojo"><? echo $sinref;?></h2>
                  </div>
              </li>
            </a>
          </ul>
        <? } ?>
      <!--div class="titulo_correo">
        <img src="http://www.comprandofacil.com/pide/corehome/img_modulos/user.png">
        <h1>NUMERO DE VISITAS</h1>
      </div-->

    </section>

    <section class="cont_blq_index">

    <?
    $var=file_get_contents("http://www.comprandofacil.com/pide/corehome/core.menu.derecho.php?codcliente=".$codcliente);
    echo $var;
    ?>

    </section>






    <?
    include("../../incluidos_modulos/navegador.principal.cerrar.php");
    include("../../incluidos_modulos/modulos.remate.php");
    ?>

    </body>
</html>