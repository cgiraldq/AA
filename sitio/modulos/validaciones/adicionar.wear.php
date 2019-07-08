<?
include("../../sessiones.php");



session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/modulos.funciones.php");
$tipocliente=2;
//$db->debug=true;
$idconsec=$_REQUEST['idconsec'];
$idproducto=$_REQUEST['idproducto'];
$idcant=$_REQUEST['idcant'];
if ($idcant=="") $idcant=1;

$idcate=$_REQUEST['idcate'];
$idsub=$_REQUEST['idsub'];

$sel_colores=$_REQUEST['idcolor'];
$sel_tallas=$_REQUEST['idtalla'];
$sel_coloresx=$sel_colores;// id color
$sel_colores=seldato("dsm","id"," ecommerce_tblcolores",$sel_colores,1);// nombre color
$sel_tallasx=$sel_tallas;//  id talla
$sel_tallas=seldato("dsm","id"," ecommerce_tbltallas",$sel_tallas,1);// nombre talla
//$db->debug=true;
$eliminar=$_REQUEST['eliminar'];
if($eliminar==""){


//==============================VALIDA  EXITENCIA ==========================================//
$sqlx1="select id,idcant";
$sqlx1.=" from ecommerce_tbltemporalcompras";
$sqlx1.=" where  dsfecha='".$_SESSION['dsfechacompra_dis'];
$sqlx1.="' and idcliente='".$_SESSION['idcomprador_dis'];
$sqlx1.="' and idproducto=$idproducto and idcolor='$sel_coloresx' and idtalla='$sel_tallasx'";
$sqlx1.=" and idsubc='$idsub' and idcate='$idcate'";
$result=$db->Execute($sqlx1);
if(!$result->EOF){
$idproductotemporal=($result->fields[0]);
$idcantx=$result->fields[1];
if($idcantx>$idcant){
$xidcantidad=1;
$t_cantidad=$idcant;
$xt_cantidad=($idcantx-$idcant);
}else{
$t_cantidad=abs($idcantx-$idcant);
}
}else{
$t_cantidad=$idcant;
}
$result->Close();
//exit();
//==============================FIN VALIDACIONE DE LA EXITENCIA==============================//



    $sql="select b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5";
    $sql.=",a.dsflete,a.iva,a.idtipo,b.dsunidad  from ecommerce_tblproductos a ";
    $sql.=",ecommerce_tbltallasxtblproductos b ";
    $sql.=" where a.id=$idproducto and b.idorigen=a.id";
    $sql.=" and b.idcolor=$sel_coloresx and b.iddestino=$sel_tallasx ";
    if($xidcantidad)$sql.=" and b.dsunidad >=$t_cantidad ";
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
$sqldes.=" and iddestino=$idproducto";
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
$sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$idproducto,1)."'";

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
$sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$idproducto,1)."'";

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
    $sql.=" where idorigen=".$idproducto;
    $sql.=" and idcolor=$sel_coloresx and iddestino=$sel_tallasx";
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
    $sql.="' and idproducto=$idproducto and idcolor='$sel_coloresx' and idtalla='$sel_tallasx'";
    $sql.=" and idsubc='$idsub' and idcate='$idcate'";
    $result=$db->Execute($sql);
    if(!$result->EOF){
    $idproductotemporal=($result->fields[0]);
    $idcantx=$result->fields[1];
    $t_cantidad=abs($idcantx-$idcant);
    if($xidcantidad==1){
    $idcantx=$idcant;
    }else{
    $idcantx=($idcantx+$t_cantidad);
    }
          $sql=" update ecommerce_tbltemporalcompras set ";
          $sql.=" idcant=$idcantx";
          $sql.=" where id=".$idproductotemporal;
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
      $sql.=" ecommerce_tbltemporalcompras set dstalla='$sel_tallas',idtalla='$sel_tallasx' ,dscolor='$sel_colores',idcolor='$sel_coloresx'  where idconsec=$idconsec ";
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
          $sql.=" values ('$idproducto','$idcant','".$_SESSION['idcomprador_dis']."','".$_SESSION['dsfechacompra_dis']."','$idprecio','$dsdescuento','$dsiva','$dstotal' ";
          $sql.=",'".$_SESSION['ipremota_dis']."','$dspordescuento','$iva',$idconsec,$idtienda,'$dsvalorflete','$sel_tallas','$sel_colores','$sel_tallasx','$sel_coloresx','$idcate','$idsub')";

} // fin de idconsec


}
$result->Close(); //cierra validacion del prodcuto si ya existe en la tabla temporal le suma el siguiente
//    echo $sql;
//   exit();
    //Para el ingreso de las especificaciones de la manilla en la tabla compras
  if ($db->Execute($sql)) {
     $data="1";
    } else {
     $data=-1;
    }


}else{
$data=3;
}
$result->Close();



}else{

// v1 06-02-2015  ===================    BLOQUE ELIMINA LOS DATOS DE LA TABLA TEMPORAL DE COMPRAS =====================================//
$sql="select id,idcant";
$sql.=" from ecommerce_tbltemporalcompras";
$sql.=" where  dsfecha='".$_SESSION['dsfechacompra_dis']."' and idcliente='".$_SESSION['idcomprador_dis']."' and idproducto=$idproducto and idcolor='$sel_coloresx' and idtalla='$sel_tallasx'";
$sql.=" and idsubc='$idsub' and idcate='$idcate'";
$r_delete=$db->Execute($sql);
if(!$r_delete->EOF){
          $idproductotemporal=($r_delete->fields[0]);
          $idcant=$r_delete->fields[1];


          $unidadesdisx=seldato("dsunidad","idorigen"," ecommerce_tbltallasxtblproductos",$idproducto." and idcolor=$sel_coloresx and iddestino=$sel_tallasx",1); // UNIDADES DISPONIBLES  DEL PRODUCTO
          $unidadesfinal =  ($unidadesdisx+$idcant);
          $sql=" update ecommerce_tbltallasxtblproductos set ";
          $sql.=" dsunidad='$unidadesfinal'";
          $sql.=" where idorigen=".$idproducto;
          $sql.=" and idcolor=$sel_coloresx and iddestino=$sel_tallasx";
          if ($db->Execute($sql))  {
                    $sqld = "delete from ecommerce_tbltemporalcompras where id=$idproductotemporal and idcliente='".$_SESSION['idcomprador_dis']."'";
                    if ($db->Execute($sqld)){
                      $idcant=0;
                    }else{
                    $data=-1;
                    }
          }else{
                    echo "Problemas al insertar ";
                    echo $db->ErrorMsg();
                    $data=-1;
          }

}else{

        $data=-1;

}
$r_delete->Close();
//=================================== FIN    BLOQUE ELIMINA LOS DATOS DE LA TABLA TEMPORAL DE COMPRAS =====================================//
}
echo $data;
?>
