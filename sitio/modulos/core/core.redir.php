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
$rutaredir=$_REQUEST['rutaredir'];
$rutacore=$_REQUEST['rutacore'];
$_SESSION['rutacore']=$rutacore;

$idrutaredir=$_REQUEST['id'];

$idmanual=$_REQUEST['idmanual'];
$dsmanual=$_REQUEST['dsmanual'];
$idtitulo=$_REQUEST['idtitulo'];
$dstitulo=$_REQUEST['dstitulo'];

$idpedido=$_REQUEST['idpedido'];
$idcliente=$_REQUEST['idcliente'];

$modulo=$_REQUEST['modulo'];


$rutacorex=$_REQUEST['rutacorex'];
if ($rutacorex<>"") {
  $partir=explode("|",$rutacorex);
  $rutaredir=$partir[0];
  $idrutaredir=$partir[1];
}

$titulomodulo="Principal";
$rutacorreoapps=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."?rutacorex=core.respuesta|id=".$idrutaredir;
// datos complementarios para uso del formulario
    $sqld="select dsnombre,dstel1,dscorreo1,dsdir1 from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
       $dsnombre=trim(reemplazar($resultd->fields[0]));
       $dstel1=trim(reemplazar($resultd->fields[1]));
       $dsdireccion=trim(reemplazar($resultd->fields[3]));
       $dscorreo1=trim(reemplazar($resultd->fields[2]));
    }
    $resultd->Close();
?>
<html>

    <?include("../../incluidos_modulos/head.php");?>
  <link rel="stylesheet" href="<? echo $rutacore?>/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
    <script src="http://www.comprandofacil.com/pide/corehome/js_modulos/corehome.js"></script>

<body>

      <? include("../../incluidos_modulos/navegador.principal.php");?>

<?
$rutax=$rutacore.$rutaredir.".cuerpo.php?id=".$idrutaredir."&rutacore=".$rutacore;

if ($rutaredir<>"core.manual.lista.detalle" && $rutaredir<>"core.tickets" && $rutaredir<>"core.tickets.nuevo" && $rutaredir<>"core.cuenta" && $rutaredir<>"core.tickets.seguimientos") {
  $rutax.="&rutacorreoapps=".$rutacorreoapps;
  $rutax.="&dstelefono=".$dstel1."&dsdireccion=".$dsdireccion."&dscorreocliente=".$dscorreo1;
}
$rutax.="&codcliente=".$codcliente;
$rutax.="&dsnombre=".$dsnombre;

if ($rutaredir<>"core.tickets" && $rutaredir<>"core.tickets.nuevo" && $rutaredir<>"core.cuenta" && $rutaredir<>"core.tickets.seguimientos") {
    $rutax.="&idmanual=".$idmanual;
    $rutax.="&dsmanual=".$dsmanual;
    $rutax.="&idtitulo=".$idtitulo;
    $rutax.="&dstitulo=".$dstitulo;
}
$rutax.="&idcliente=".$idcliente;
$rutax.="&idpedido=".$idpedido;
$rutax.="&modulo=".$modulo;
//echo $rutax;
$var=file_get_contents($rutax);
echo $var;

?>
 
    <?
    include("../../incluidos_modulos/navegador.principal.cerrar.php");
    include("../../incluidos_modulos/modulos.remate.php");
    ?>

    </body>
</html>