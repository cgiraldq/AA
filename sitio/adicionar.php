<?
include("sessiones.php");
  $idproducto=$_REQUEST['idproducto'];
 if ($idproducto=="") {
  header("Location: index.php");
 }
 $idcant=$_REQUEST['idcant'];
 $sel_colores=$_REQUEST['sel_colores'];
 $sel_tallas=$_REQUEST['sel_tallas'];
 $idconsec=$_REQUEST['idconsec'];

 if ($idcant=="") $idcant=1;
/*
foreach($_REQUEST as $name=>$val){
    echo($name.'='.$val.'<br>');
}
*/


//exit();
// PROCESO DE ADICIONAR PRODUCTO
 $ruta=1; // ruta cambiada para las variables
  if($rutap==1)$ruta=4;
  include($rut."incluidos_modulos/modulos.funciones.php");
  include($rut."incluidos_modulos/version.php");
  include($rut."incluidos_modulos/comunes.php");
  include($rut."incluidos_modulos/varconexion.php");
  include($rut."incluidos_modulos/sql.injection.php");
  if ($_SESSION['i_idcliente']<>"")  $tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],1);//
// $db->debug=true;
    $sql="select precio1,precio2,precio3,precio4,precio5,dsflete,iva,idtipo,dsunidadesdispo  from ecommerce_tblproductos where id=$idproducto";
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
    }




                          //*********  Bloque  Valores Segun Tipo Cliente ******************
                      $tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],1);
                      if($tipocliente==2) {
                      $xprecio=2;  
                      $idprecio=$precio2;
                      }elseif($tipocliente==3){
                        $xprecio=3;
                      $idprecio=$precio3;
                      }elseif($tipocliente==4){
                        $xprecio=4;
                      $idprecio=$precio4;
                      }elseif($tipocliente==5){
                       $xprecio=5;
                      $idprecio=$precio5;
                      }else{
                      $xprecio=1;
                      $idprecio=$precio1;
                      }
                      //*********  Fin Bloque  Valores Segun Tipo Cliente ******************
                      //**********************inicio  Valor De La Promocion ***********************// 
                       

                        
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$idproducto or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                       // echo "<br>".$sqldes."<br>--productos";
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
                       // echo "<br>".$sqldes."<br>--Categoria";
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
                        //echo $sqldes."<br>--Sub";
                        $resultx=$db->Execute($sqldes);
                        if(!$resultx->EOF){
                        $xpromosubcategoria=1; 
                        $promodescuento=($resultx->fields[1]);
                        $idpreciox=($resultx->fields[2]);
                        }$resultx->Close();//  Fin Subcategoria
                        }$resultY->Close();// Fin  promocion Categoria
                        }$result_des->Close();// Fin  promocion producto


                        $dspordescuento=$promodescuento;
                        //echo "<br>".$idprecio."<br>".$xprecio;

          //****Modifica la cantidad del producto Inicio****//
          $unidadesfinal=$unidadesdispnibles-1;
          $sql=" update ecommerce_tblproductos set ";
          $sql.=" dsunidadesdispo='$unidadesfinal'";
          $sql.=" where id=".$idproducto;
          if ($db->Execute($sql))  {
          }else{
          echo "Problemas al insertar ";
          echo $db->ErrorMsg();
          exit();
          $redir="index.php";
          }
          //****Modifica la cantidad del producto Fin****//


    $sql="select id,idcant";
    $sql.=" from ecommerce_tbltemporalcompras";
    $sql.=" where  dsfecha='".$_SESSION['dsfechacompra']."' and idcliente='".$_SESSION['idcomprador']."' and idproducto=$idproducto";
    $result=$db->Execute($sql);
    if(!$result->EOF){
    $idproductotemporal=($result->fields[0]);
    $idcant=($result->fields[1]+1);

          $sql=" update ecommerce_tbltemporalcompras set ";
          $sql.=" idcant=$idcant";
          $sql.=" where id=".$idproductotemporal;
          if ($db->Execute($sql))  {
          }else{
          echo "Problemas al insertar ";
          echo $db->ErrorMsg();
            // enviar correo con el problema
          exit();
          $redir="index.php";
          }

  }else{

  if($_SESSION['idcomprador']==""){
    $_SESSION['idcomprador']=session_id();
    $_SESSION['dsfechacompra']=date("YmdHis");
    $_SESSION['ipremota']=$remoto;

  } //cierra sessiones
// datos del producto
  /*
    $idprecio=seldato('precio1','id','tblproductos',$idproducto,1);
    $dspordescuento=seldato('descuento','id','tblproductos',$idproducto,1);
    $iva=seldato('iva','id','tblproductos',$idproducto,1);
    $idtipo=seldato('idtipo','id','tblproductos',$idproducto,1);
    $dsvalorflete=seldato('precio2','id','tblproductos',$idproducto,1); // en caso que lo tenga se debe tener como base para los calculos
*/  
    $dsdescuento=$idprecio-$idprecio*($dspordescuento/100);
    $subtotal=$dsdescuento;
    $dsiva=$subtotal*($iva/100);
    $dstotal=$subtotal+$dsiva;
    $tabla="ecommerce_tbltemporalcompras";

if ($_REQUEST['idconsec']>0) {

      $sql=" update ";
      $sql.=" ecommerce_tbltemporalcompras set dstalla='$sel_tallas',dscolor='$sel_colores'  where idconsec=$idconsec ";
      $sql.=" and dsfecha='".$_SESSION['dsfechacompra']."' and idcliente='".$_SESSION['idcomprador']."' and idtienda=$idtienda ";

    } else {
          $sql="select max(idconsec) as t from  ecommerce_tbltemporalcompras  ";
          $sql.=" where dsfecha='".$_SESSION['dsfechacompra']."' and idcliente='".$_SESSION['idcomprador']."' and idtienda=$idtienda ";
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
          $sql="insert into $tabla (idproducto,idcant,idcliente,dsfecha,idprecio,dsdescuento,dsiva,dstotal,idip,dspordescuento,dsporiva,idconsec,idtienda,dsvalorflete,dstalla,dscolor)";
          $sql.=" values ('$idproducto','$idcant','".$_SESSION['idcomprador']."','".$_SESSION['dsfechacompra']."','$idprecio','$dsdescuento','$dsiva','$dstotal' ";
          $sql.=",'".$_SESSION['ipremota']."','$dspordescuento','$iva',$idconsec,$idtienda,'$dsvalorflete','$sel_tallas','$sel_colores')";

} // fin de idconsec


}
$result->Close(); //cierra validacion del prodcuto si ya existe en la tabla temporal le suma el siguiente
//    echo $sql;
//   exit();
    //Para el ingreso de las especificaciones de la manilla en la tabla compras
  if ($db->Execute($sql)) {

  $tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],1);//

if($tipocliente==2) {
  $rutax="carrito.distribuidor.php";
}else{
  $rutax="carrito.php";
}




      $redir=$rutax."?idproducto=$idproducto&idconsec=$idconsec";

      if ($idtipo==5) $redir="ecommerce.productos.detalle.mensaje.php?idproducto=$idproducto&idconsec=$idconsec";

  } else {
      echo "Problemas al insertar ";
      echo $db->ErrorMsg();
      // enviar correo con el problema
      exit();
      $redir="index.php";
  }

//exit;

//exit;

 include($rut."incluidos_modulos/cerrarconexion.php");
 include($rut."redir.php");
?>