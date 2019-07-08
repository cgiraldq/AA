<?
include("sessiones.php");
$idx=$_REQUEST['idx'];
 $cant=$_REQUEST['cant'];
 $cantd=$_REQUEST['cantd'];
 $cantif=$cant+$cantd;
 $idprod=$_REQUEST['idprod'];
$tipocliente=$_REQUEST['tipocliente'];
if($tipocliente==2){
$redir="carrito.distribuidor2.php";
}else{
$redir="carrito.php";
}
if ($_REQUEST['redir']<>"") {
    $partir=explode("|",$_REQUEST['redir']);
    $redir=$partir[0]."?".$redir[1];
}
 if ($idx=="") {
  header("Location: $redir");
 }
  if($_SESSION['idcomprador']==""){
  header("Location: index.php");
 }
  // PROCESO DE ELIMINAR PRODUCTO
  $ruta=1; // ruta cambiada para las variables
  if($rutap==1)$ruta=4;
  include($rut."incluidos_modulos/modulos.funciones.php");
  include($rut."incluidos_modulos/version.php");
  include($rut."incluidos_modulos/comunes.php");
  include($rut."incluidos_modulos/varconexion.php");
  include($rut."incluidos_modulos/sql.injection.php");


  $tabla="ecommerce_tbltemporalcompras";
  $sql=" delete from  $tabla where id=$idx";
  if ($db->Execute($sql)) {
  } else {
     echo "Problemas al insertar ";
      // enviar correo con el problema
      exit();
      $redir="index.php";
  }
  if($cant<>""){

  $sql=" update ecommerce_tblproductos set ";
  $sql.=" dsunidadesdispo='$cantif'";
  $sql.=" where id=".$idprod;
  //echo $sql;
  //exit;
   $db->Execute($sql);
}

//exit;

// si ya no hay mas datos que eliminar que lo mande al index
  $sql="select id ";
  $sql.=" from ecommerce_tbltemporalcompras where  ";
  $sql.=" idcliente='".$_SESSION['idcomprador']."' and dsfecha='".$_SESSION['dsfechacompra']."' ";
  $sql.=" and idip='".$_SESSION['ipremota']."' and idtienda=$idtienda ";

     // echo $sql;
     // exit();
      $result=$db->Execute($sql);
      if($result->EOF){
        $redir="index.php";
      }
      $result->Close();

   include($rut."incluidos_modulos/cerrarconexion.php");
    include($rut."redir.php");

?>
