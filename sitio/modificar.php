<?
include("sessiones.php");
$idx=$_REQUEST['idx'];
$modvalor=$_REQUEST['modvalor'];
$idpro=$_REQUEST['idpro'];
//echo "<br>";
$cantidadactual=$_REQUEST['cantidad']; //cantidad actual seleccionada
$unidaddisponible=$_REQUEST['unidaddisponible'];
//exit;
$contarx=count($idx);
$tipocliente=$_REQUEST['tipocliente'];
$clientex=$_REQUEST['clientex'];
if($tipocliente==1){
$redir="carrito.distribuidor2.php";
}else{
$redir="carrito.php";
}
if ($_REQUEST['redir']<>"") $redir=$_REQUEST['redir'];
if ($contarx<=0) {
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
if($clientex==1){
$contar=count($_REQUEST['cantidad']);
    $h=0;
      for ($j=0;$j<$contar;$j++){
        //echo "entraxx";
        if ($_REQUEST['cantidad'][$j]<>""){
            $cantidadant[$j]=seldato("idcant","id","ecommerce_tbltemporalcompras",$idx[$j],1); // cantidad anterior selecionada // CUANDO ES CLIENTE VALE 1
         //echo "<br>";
          //$unidadsuma[$j]=$cantidadactual[$j]-$cantidadant[$j];
            $unidadsuma[$j]=$cantidadant[$j]-$cantidadactual[$j];
         //echo "<br>";
            $unidadfinal[$j]=$unidadsuma[$j]+$unidaddisponible[$j];
        // exit;
         //  echo "<br>";
          $sql=" update ecommerce_tblproductos set ";
          $sql.= "dsunidadesdispo='".$unidadfinal[$j]."'";
          //$sql.= ",dsm='".(str_replace(chr(39),"&#39",$_REQUEST['dsm_'][$j]))."'";
          $sql.= " where id=".$idpro[$j];
        //  echo "<br>";
          //echo $sql;
      // exit;
          if ($db->Execute($sql)) $h++;
        } // fin si
      }
}else{

   $contar=count($_REQUEST['cantidad']);
    $h=0;
      for ($j=0;$j<$contar;$j++){
        if ($_REQUEST['cantidad'][$j]<>""){
           $cantidadant[$j]=seldato("idcant","id","ecommerce_tbltemporalcompras",$idx[$j],1);
        //  echo "<br>";
        //  echo $unidadsuma[$j]=$cantidadactual[$j]-$cantidadant[$j];
          $unidadsuma[$j]=$cantidadant[$j]-$cantidadactual[$j];
          //echo "<br>";
          $unidadfinal[$j]=$unidadsuma[$j]+$unidaddisponible[$j];
        // exit;
          $sql=" update ecommerce_tblproductos set ";
          $sql.= "dsunidadesdispo='".$unidadfinal[$j]."'";
          //$sql.= ",dsm='".(str_replace(chr(39),"&#39",$_REQUEST['dsm_'][$j]))."'";
          $sql.= " where id=".$idpro[$j];
       // echo $sql;
      //   exit;
          if ($db->Execute($sql)) $h++;
        } // fin si
      }
}
//exit;
  $tabla="ecommerce_tbltemporalcompras";
    $h=0;
      for ($j=0;$j<$contarx;$j++){
        if ($_REQUEST['cantidad'][$j]>0){
          $sql=" update $tabla set ";
          $sql.= "idcant=".$_REQUEST['cantidad'][$j];
          $partir=explode("|",$_REQUEST['dsciudadenvio'][$j]);
          $dsciudad=$partir[0];
          $dsflete=$partir[1];
          if ($_REQUEST['dspara'][$j]<>"") $sql.= ",dspara='".$_REQUEST['dspara'][$j]."'";
          if ($dsciudad<>"") $sql.= ",dsciudadenvio='".$dsciudad."'";
          if ($dsflete<>"") $sql.= ",dsvalorenvio='".$dsflete."'";
          if ($_REQUEST['dstelefonoenvio'][$j]<>"") $sql.= ",dstelefonoenvio='".$_REQUEST['dstelefonoenvio'][$j]."'";
          if ($_REQUEST['dsdireccionenvio'][$j]<>"") $sql.= ",dsdireccionenvio='".$_REQUEST['dsdireccionenvio'][$j]."'";
          if ($_REQUEST['dsmensajeenvio'][$j]<>"") $sql.= ",dsmensajeenvio='".$_REQUEST['dsmensajeenvio'][$j]."'";
          if ($_REQUEST['dsobsenvio'][$j]<>"") $sql.= ",dsobsenvio='".$_REQUEST['dsobsenvio'][$j]."'";
          $sql.= " where id=".$idx[$j];
             if ($db->Execute($sql)) {
                $h++;
             } else {
                  echo "Problemas con la base de datos";
                  // enviar correo con el problema
                  exit();
             }
        } // fin si
      } // fin for
    include($rut."incluidos_modulos/cerrarconexion.php");
    include($rut."redir.php");
?>