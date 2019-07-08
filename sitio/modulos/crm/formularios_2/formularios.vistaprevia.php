<?

$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$apagar=1;


$idx=$_REQUEST['idx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];

//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="listado.php";
$titulomodulo="Listado de formularios";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='".$rr."' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Formulario de Ingreso</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
         		<h1> Ingreso de nuevo registro en formulario <? echo seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idx'],2);?></h1>

          </td>
        </tr>
</table>



<form action="../../validaciones/validar.formularios.php" method=post id="u" name=u>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
          <? include('formulario.seleccionar.tipo.php');?>
</table>
<input type="hidden" name="idcliente" value="<? echo $_REQUEST['idcliente'];?>">

<?
$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen  and a.idformulario=$idx and a.id='".$_REQUEST['agrupamiento']."' group by a.dsm";
 //echo $sql;
 $result=$db->Execute($sql);
   		if (!$result->EOF) {


        $sqlx=" select a.id,a.dsm from  framecf_tbltiposformulariosxcamposxagrupamientoxtemasxagrupados a,";

        $sqlx.=" tblagrupamientoxtblformulariosxtemasxagrupados b";

        $sqlx.=" where a.idformulario='$idx' and a.id=b.idorigen and a.idactivo=1  and a.idagrupamiento='".$_REQUEST['agrupamiento']."'  ";

       //echo $sqlx;
         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {

            include('formularioxtemasxagrupamiento.php');

          }else{
           // aqui pinta los campos por agrupamiento de campos
        $idreferencia=$result->fields[2];
        include('formulariosxagrupamientos.php');
          }
          $resultx->Close();




   		}else{
        $sqlx=" select id,dsm from framecf_tbltiposformulariosxcamposxagrupamientoxtemas where idformulario=$idx";
        //echo $sqlx;
         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {
             // pinta los campos por temas // sin agrupamientos
              include('formulariosxtemas.php');

          }else{
            // aqui pinta los campos normalmente
            include('formulariosxagrupamientos.php');

          }
          $resultx->Close();



   		}
   		$result->Close();

     if($idformulario==104 && $agrupamiento<>"") include("formulario.puntoscercanos.php");



?>

<tr>
  <td align="center" colspan="4">
    <input type="hidden" name="idagrupamiento" value="<? echo $agrupamiento;?>">
    <input type="hidden" name="idcliente" value="<? echo $_REQUEST['idcliente'];?>">

  <? if($_REQUEST['idx']<>104){?>
    <input type="hidden" name="idusuario" value="<? echo $_SESSION['i_idusuario'];?>">
  <?}?>

    <?
      $ingresar=1;
      $mostracamposocultos="";
      include($rutxx."../../incluidos_modulos/botones.modificar.php");
    ?>
  </td>
</tr>



</td>
</tr>




</table>


</form>





<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

<?include("formulario.direcciones.php");?>

<script type="text/javascript">

  function agrupamiento_campos(valor){
    ///alert("entra");
    if(document.u.agrupamiento.value!=""){
      //alert("entra");

      document.getElementById('u').action="formularios.vistaprevia.php";
      document.getElementById('u').submit();
    }

  }
</script>

