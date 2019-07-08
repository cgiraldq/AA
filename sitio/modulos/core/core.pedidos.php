<?
/*
| ----------------------------------------------------------------- |
Cf-ecommerce
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Listado de las compras
?>



<table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
     <td align="left" valign="middle" class="titulo_index">
       <h1> &Uacute;ltimos pedidos registrados</h1>
      </td>
    </tr>
</table>



  <?
$maxregistros=10;
$sql="select a.id,a.dsciudadflete,a.dssubtotal,a.dsflete";
$sql.=",a.dsiva,a.dstotal,a.idestado,a.dsfecha,a.dsformadepago,a.idcliente,a.idtipocomp";
$sql.=",a.idpedido,a.idclientepago,a.dsdescuento,a.dsfechalarga,a.dscampo1,a.idtienda";
$sql.=" from tblpagos a ";
$sql.=" order by a.id desc ";

//echo $sql;
include("../../incluidos_modulos/paginar.variables.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if (!$result->EOF) {
$contar=0;

?>
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tbl_internas_index">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">


          <table width="100%">

                <tr>
                    <td align="right" colspan="4" valign="top" class="texto_normal"><a href="../compras/default.php" class="textazullink">Ver Todos</a><br><br></td>
                  </tr>


                  <tr bgcolor="#F7F7F7">
                    <td align="center" valign="top" class="texto_normal">ID Pedido</td>
                    <td align="center" valign="top" class="texto_normal">Fecha</td>

                    <td align="center" valign="top" class="texto_normal">Nombre cliente </td>
                    <td align="center" valign="top" class="texto_normal">Opcion</td>
                  </tr>

            <? while (!$result->EOF){
            if ($contar%2==0) {
            $fondo=$fondo1;
          } else {
            $fondo=$fondo2;
          }
                $dsnombrescom=seldato("dsnombres","id","tblclientes",$result->fields[12],1);
      $dsapellidoscom=seldato("dsapellidos","id","tblclientes",$result->fields[12],1);

          ?>

                  <tr class="texto_normal2" align="center" valign="top"  bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
                        <td align="center" class='textazullink'><? echo $result->fields[11]?></td>

      <td align="center" >
      <? echo $result->fields[14];?>
    </td>

    <td align="center"><A title="Click para ver y actualizar los datos de un cliente" HREF="javascript:irAPaginaDN('../clientesregistrados/default.php?enca=1&idclientepago=<? echo $result->fields[12]; ?>',100,100)"><? echo $dsnombrescom." ".$dsapellidoscom; ?></a></td><!--cliente-->
                    <td align="center" valign="top"><?
      $mrutax="Detalle";
      $rutax="javascript:irAPaginaDN('../../proceso.pago.impresion.php?idtienda=".$result->fields[16]."&mostrarenlace=1&dscampo1=$dscampo1&idpedido=".$result->fields[11]."&idclientepago=".$result->fields[12]."',100,100)";
      include("../../incluidos_modulos/enlace.generico.php");?>
</td>
                  </tr>

          <?
  $contar++;
      $result->MoveNext();
  } // fin while
?>

                </table>
      <br />

    </td>
        </tr>
      </table>


<?
} // fin si
$result->Close();
?>
