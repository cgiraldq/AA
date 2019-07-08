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
// Listado de los modulos autorizados basandose en los permisos de usuarios
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
     <td align="left" valign="middle" class="titulo_index">
       <h1> Estado actual de los productos</h1>
      </td>
    </tr>
</table>



	  <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tbl_internas_index">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">

                  <tr>
                    <td align="right" colspan="4" valign="top" class="texto_normal"><a href="../listaproductos/default.producto.php" class="textazullink">Ver Todos</a><br><br></td>
                  </tr>


              <tr>
                <td height="20" align="center" valign="middle" bgcolor="#F7F7F7">

                  <table width="100%"  bgcolor="#F7F7F7">
                  <tr>
                    <td align="center" valign="top" class="texto_normal">Tipo</td>
                    <td align="center" valign="top" class="texto_normal">Cantidad</td>
                  </tr>


                  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin precio</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sinprecio="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (precio1='' or precio1 is null or precio1=0) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sinprecio="<a class='textazullink' href='../listaproductos/default.producto.php?sinprecio=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sinprecio;


                       ?>

                    </td>
                  </tr>

                  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin valor flete</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sintrans="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (precio2='' or precio2 is null or precio2=0) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sintrans="<a class='textazullink' href='../listaproductos/default.producto.php?sintrans=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sintrans;


                       ?>

                    </td>
                  </tr>


    <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin valor de descuento</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sindescuento="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (preciodescuento='' or preciodescuento is null or preciodescuento=0) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sindescuento="<a class='textazullink' href='../listaproductos/default.producto.php?sindescuento=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sindescuento;


                       ?>

                    </td>
                  </tr>



    <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos con una sola imagen</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sinimagen="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where dsimg1<>'' and ((dsimg2='' or dsimg2 is null) and (dsimg3='' or dsimg3 is null) and (dsimg4='' or dsimg4 is null) and (dsimg5='' or dsimg5 is null) and (dsimg6='' or dsimg6 is null) and (dsimg7='' or dsimg7 is null) and (dsimg8='' or dsimg8 is null) and (dsimg9='' or dsimg9 is null) and (dsimg10='' or dsimg10 is null)) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sinimagen="<a class='textazullink' href='../listaproductos/default.producto.php?sinimagen=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sinimagen;


                       ?>

                    </td>
                  </tr>





    <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin imagen</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sinimagen_1="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (dsimg1='' or dsimg1 is null) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sinimagen_1="<a class='textazullink' href='../listaproductos/default.producto.php?sinimagen_1=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sinimagen_1;


                       ?>

                    </td>
                  </tr>


    <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin descripcion corta o resumen</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sindesc="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (dsd='' or dsd is null) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sindesc="<a class='textazullink' href='../listaproductos/default.producto.php?sindesc=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sindesc;


                       ?>

                    </td>
                  </tr>


    <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                    <td align="center" valign="top" class="texto_normal2">Productos sin referencia</td>
                    <td align="center" valign="top" class="texto_normal2">
                      <?

$sinref="";
// saber si ya esta asociado en la tabla de productos
$sql="select count(*) as total from tblproductos where (dsreferencia='' or dsreferencia is null) ";
$resultx=$db->Execute($sql);
  if (!$resultx->EOF) {

    $sinref="<a class='textazullink' href='../listaproductos/default.producto.php?sinref=1'>".$resultx->fields[0]."</a>";
  }
  $resultx->Close();
echo $sinref;


                       ?>

                    </td>
                  </tr>




                </table></td>
              </tr>
          </table>
		  <br />

    </td>
        </tr>
      </table>
