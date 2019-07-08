<?
session_start();
$ruta=1;
include("incluidos_modulos/comunes.php");
include("incluidos_modulos/modulos.funciones.php");
include("incluidos_modulos/varconexion.php");
//$db->debug=true;
$idpedido=$_REQUEST['idpedido'];
$sql="select a.idproducto,a.idcant,a.idcolor";
$sql.=",a.dstalla,a.dscolor,a.idtalla,a.idsubc,a.idcate from ecommerce_tblcompras a  where a.idpedido=".$idpedido;
$resultx1 = $db->Execute($sql);
if (!$resultx1->EOF) {
while (!$resultx1->EOF) {
$idp=$resultx1->fields[0];
$idcant=$resultx1->fields[1];
$idcolor=$resultx1->fields[2];
$dstalla=$resultx1->fields[3];
$dscolor=$resultx1->fields[4];
$idtalla=$resultx1->fields[5];
$idsub=$resultx1->fields[6];
$idcate=$resultx1->fields[7];

$t_cantidad=$idcant;
//==============================FIN VALIDACIONE DE LA EXITENCIA==============================//



    $sql="select b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5";
    $sql.=",a.dsflete,a.iva,a.idtipo,b.dsunidad  from ecommerce_tblproductos a ";
    $sql.=",ecommerce_tbltallasxtblproductos b ";
    $sql.=" where a.id=$idp and b.idorigen=a.id";
    $sql.=" and b.idcolor=$idcolor and b.iddestino=$idtalla ";
    if($t_cantidad)$sql.=" and b.dsunidad >=$t_cantidad ";
    $result=$db->Execute($sql);
    if(!$result->EOF){
    $precio1=$result->fields[0];
    $precio2=$result->fields[1];
    $precio3=$result->fields[2];
    $precio4=$result->fields[3];
    $precio5=$result->fields[4];  
    $dsvalorflete=$result->fields[5];
    $iva=$result->fields[6];
    $idtipo=$result->fields[7];
    $unidadesdispnibles=$result->fields[8];


    $xprecio=2;  
    $idprecio=$precio2;

//*********  Fin Bloque  Valores Segun Tipo Cliente ******************//
//**********************inicio  Valor De La Promocion ***********************// 

$sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
$sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
$sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
$sqldes.=" and b.idprecio=$xprecio ";
$sqldes.=" and iddestino=$idp";
$sqldes.=" and b.idorigen=a.id ";

$result_des=$db->Execute($sqldes);
if(!$result_des->EOF){
$xpromoproducto=1;
$promodescuento=($result_des->fields[1]);
$idpreciox=($result_des->fields[2]);


}else{
$sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
$sqldes.="ecommerce_tblpromocionesxcategoria b where  1 and idactivo not in (2,9) ";
$sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
$sqldes.=" and b.idprecio=$xprecio ";
$sqldes.=" and b.idorigen=a.id ";
$sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$idp,1)."'";

$resultY=$db->Execute($sqldes);
if(!$resultY->EOF){
$xpromocatecoria=1;  
$promodescuento=($resultY->fields[1]);
$idpreciox=($resultY->fields[2]);
}else{

$sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
$sqldes.=" ecommerce_tblpromocionesxsubcategoria b where  1 and idactivo not in (2,9) ";
$sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
$sqldes.=" and b.idprecio=$xprecio ";
$sqldes.=" and b.idorigen=a.id ";
$sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$idp,1)."'";

$resultx=$db->Execute($sqldes);
if(!$resultx->EOF){
$xpromosubcategoria=1; 
$promodescuento=($resultx->fields[1]);
$idpreciox=($resultx->fields[2]);

}$resultx->Close();//  Fin Subcategoria
}$resultY->Close();// Fin  promocion Categoria
}$result_des->Close();// Fin  promocion producto

if($promodescuento=="")$promodescuento=0;
$dspordescuento=$promodescuento;


    //****Modifica la cantidad del producto Inicio****//
    if($xidcantidad==1){
    $unidadesfinal=$unidadesdispnibles+$xt_cantidad;
    }else{
    $unidadesfinal=$unidadesdispnibles-$t_cantidad;
    }


    $sql=" update ecommerce_tbltallasxtblproductos set ";
    $sql.=" dsunidad='$unidadesfinal'";
    $sql.=" where idorigen=".$idp;
    $sql.=" and idcolor=$idcolor and iddestino=$idtalla";
    if ($db->Execute($sql))  {
    }else{
    echo "Problemas al insertar ";
    echo $db->ErrorMsg();
    exit();
    $data=-1;
    }
    //****Modifica la cantidad del producto Fin****//
    //exit();

    $sql="select id,idcant";
    $sql.=" from ecommerce_tbltemporalcompras";
    $sql.=" where  dsfecha='".$_SESSION['dsfechacompra_dis'];
    $sql.="' and idcliente='".$_SESSION['idcomprador_dis'];
    $sql.="' and idproducto=$idp and idcolor='$idcolor' and idtalla='$idtalla'";
    $sql.=" and idsubc='$idsub' and idcate='$idcate'";
    $result=$db->Execute($sql);
    if(!$result->EOF){
    $ixdproductotemporal=($result->fields[0]);
    $idcantx=$result->fields[1];
    $t_cantidad=abs($idcantx-$idcant);
    if($xidcantidad==1){
    $idcantx=$idcant;
    }else{
    $idcantx=($idcantx+$t_cantidad);
    }
          $sql=" update ecommerce_tbltemporalcompras set ";
          $sql.=" idcant=$idcantx";
          $sql.=" where id=".$ixdproductotemporal;
          if ($db->Execute($sql))  {
          }else{
           $data=-1;
          }






  }else{

  if($_SESSION['idcomprador_dis']==""){

    $_SESSION['idcomprador_dis']=session_id();
    $_SESSION['dsfechacompra_dis']=date("YmdHis");
    $_SESSION['ipremota_dis']=$remoto;

  } //cierra sessiones

    $dsdescuento=$idprecio-$idprecio*($dspordescuento/100);
    $subtotal=$dsdescuento;
    $dsiva=$subtotal*($iva/100);
    $dstotal=$subtotal+$dsiva;
    $tabla="ecommerce_tbltemporalcompras";

if ($_REQUEST['idconsec']>0) {

      $sql=" update ";
      $sql.=" ecommerce_tbltemporalcompras set dstalla='$dstalla',idtalla='$idtalla' ,dscolor='$dscolor',idcolor='$idcolor'  where idconsec=$idconsec ";
      $sql.=" and dsfecha='".$_SESSION['dsfechacompra_dis']."' and idcliente='".$_SESSION['idcomprador_dis']."' and idtienda=$idtienda and idsubc='$idsub' and idcate='$idcate' ";

    } else {
          $sql="select max(idconsec) as t from  ecommerce_tbltemporalcompras  ";
          $sql.=" where dsfecha='".$_SESSION['dsfechacompra_dis']."' and idcliente='".$_SESSION['idcomprador_dis']."' and idtienda=$idtienda ";
              $result=$db->Execute($sql);
              if(!$result->EOF){
                $idconsecx=$result->fields[0];
                if ($idconsecx=="") {
                  $idconsec=0;
                } else {
                  $idconsec=$idconsecx+1;
                }
              } else {
                $idconsec=1;
              }
              $result->Close();
         // fn datos del producto
          $sql="insert into $tabla (idproducto,idcant,idcliente,dsfecha,idprecio,dsdescuento,dsiva,dstotal,idip,dspordescuento,dsporiva,idconsec,idtienda,dsvalorflete,dstalla,dscolor,idtalla,idcolor,idcate,idsubc)";
          $sql.=" values ('$idp','$idcant','".$_SESSION['idcomprador_dis']."','".$_SESSION['dsfechacompra_dis']."','$idprecio','$dsdescuento','$dsiva','$dstotal' ";
          $sql.=",'".$_SESSION['ipremota_dis']."','$dspordescuento','$iva',$idconsec,$idtienda,'$dsvalorflete','$dstalla','$dscolor','$idtalla','$idcolor','$idcate','$idsub')";

} // fin de idconsec


}
$result->Close(); 

  if ($db->Execute($sql)) {

    } else {
    $productosin[]=$idp;
    }


}else{

$productosin[]=$idp."|".$idtalla."|".$idcolor."|".$idsub."|".$idcate;

}
$result->Close();


$contar=count($productosin);


for ($i=0; $i <$contar ; $i++) { 

$productosin[$i];

}








$resultx1->MoveNext();
}
}
$resultx1->close();


include("incluidos_modulos/cerrarconexion.php");
?>
<html>
<head>
</head>
<body color=#ffffff  topmargin=10 leftmargin=0 class=text1 >
<form action="zona.distribuidor.php#pedidos" method="post" name="respuesta">
<?for ($i=0; $i <$contar; $i++) { ?>
<input type="hidden" name="producto[]" value="<?echo $productosin[$i]?>">
<?}?>
</form>
</body>
</html>
<script type="text/javascript">
regresar();
function regresar() {
document.respuesta.submit()
}
</script>