<?
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/
$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$apagar=1;
//$db->debug=true;

$idx=$_REQUEST['idx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];

$rr="listado.php";
if ($r==99) $rr="registros.php?idgaleria=$idgaleria&idxx=$idx";

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
<section class="cont_general">

<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
    <tr>
     	<td align="left" valign="middle">
     		<h1> Ingreso de nuevo registro en formulario <? echo seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idx'],2);?></h1>
      </td>
    </tr>
</table>

<form action="../../validaciones/validar.formularios.php" method=post id="u" name=u enctype="multipart/form-data">

<table align="center"  cellspacing="1" border="0" width=100% class="campos_ingreso">
  <? include('formulario.seleccionar.tipo.php');?>
</table>

<input type="hidden" name="idcliente" value="<? echo $_REQUEST['idcliente'];?>">
<input type="button" name="tiny[]" id="tiny[]" value="Activar editor de texto" class="botones" onclick="validar_tiny('u');">

<? if($_REQUEST['idx'] == 58 && $_REQUEST['estado']<>"" ){ ?>
  <input type="hidden" name="numero_de_cotizacion" value="<? echo $_REQUEST['numero_de_cotizacion'];?>">
  <p>Seguimientos a la cotizaci&oacute;n numero: <? echo $_REQUEST['numero_de_cotizacion']; ?></p>
<? }?>

<? if($_REQUEST['idx'] == 70){ ?>
  <input type="hidden" name="idprecio" value="<? echo $_REQUEST['idprecio'];?>">
<? }?>

<? if($_REQUEST['idx'] == 59 && $_REQUEST['estado']<>"" ){ ?>
  <input type="hidden" name="numero_de_cotizacion" value="<? echo $_REQUEST['numero_de_cotizacion'];?>">
  <input type="hidden" name="estado" value="<? echo $_REQUEST['estado'];?>">
  <p>Rechazar la cotizaci&oacute;n numero: <? echo $_REQUEST['numero_de_cotizacion']; ?></p>
<? }?>
 <? if($_REQUEST['idx']==70){?>
      <input type="hidden" name="idcampo" value="<? echo $_REQUEST['idcampo'];?>">
    <? }?>


<?
$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen  and a.idformulario=$idx and a.id='".$_REQUEST['agrupamiento']."' group by a.dsm";
 //echo $sql;
 $result=$db->Execute($sql);
   		if (!$result->EOF) {

        ///
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
       // echo $sqlx;
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

     //if($idformulario==104 && $agrupamiento<>"") include("formulario.puntoscercanos.php");

      $sql="SELECT iddestino FROM tblrelacionesxtblformulariosxcomplementos WHERE idorigen=".$_REQUEST['idx'];
     //$sql."<br>";
    //echo $sql;
    $resultcomplemento=$db->Execute($sql);
      if (!$resultcomplemento->EOF) {

        $contxy="1";
        while (!$resultcomplemento->EOF) {
          $interno=1;
            if($contxy==2)$contxy="1";
            $idx=$resultcomplemento->fields[0];

           $dsmform=seldato("dsm","id","framecf_tbltiposformularios",$idx,2);
           $dstablac=seldato("dstabla","id","framecf_tbltiposformularios",$idx,2);

           ?>

          <h1><? echo reemplazar($dsmform);?></h1>

           <?

           include('formulariosxcomplemento.php');
           $contxy++;
           include('formulariosxcomplemento.php');
          include('formulariosxcomplemento.php');
           include('formulariosxcomplemento.php');
          include('formulariosxcomplemento.php');
          $resultcomplemento->MoveNext();

        }

      }

      $resultcomplemento->Close();


?>

<nav class="nav_izq">

    <input type="hidden" name="idagrupamiento" value="<? echo $agrupamiento;?>">
    <input type="hidden" name="idcliente" value="<? echo $_REQUEST['idcliente'];?>">
    <input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
    <input type="hidden" name="r" value="<? echo $r?>">
    <input type="hidden" name="formulario" value="<? echo $idformulario;?>">
    <input type="hidden" name="editar" value="<? echo $ideditar;?>">
    <input type="hidden" name="idy" value="<? echo $idy;?>">
    <input type="button" name="tiny[]" id="tiny[]" value="Activar editor de texto" class="botones" onclick="validar_tiny('u');">



    <input type="hidden" name="idusuario" value="<? echo $_SESSION['i_idusuario'];?>">
    <? if($_REQUEST['obs']<>"" && $_REQUEST['cliente_asociado']<>""){ ?>
    <input type="button" name="enviar" value="Ir al Agendamiento" class="botones" onclick="irAPaginaD('../agenda/default.php?idusuario=<? echo $_SESSION['i_idusuario']; ?>');">
    <?
    }if($_REQUEST['princ']==1)
    {
      ?>
      <input type="button" name="enviar" value="Ir al Principal" class="botones" onclick="irAPaginaD('../../core.administrador/default.php');">
      <?
    }
    if( $_REQUEST['rapido']==1)
    {
      ?>
      <input type="button" name="enviar" value="Ir al Principal" class="botones" onclick="irAPaginaD('../../core.administrador/default.php');">
      <input type="button" name="enviar" value="Ir al Registro Rapido" class="botones" onclick="irAPaginaD('../registro/registro.rapido.php?param=<? echo $_REQUEST['param'] ?>&campo=<? echo $_REQUEST['campo'] ?>');">

      <?
    }

      $ingresar=1;
      $mostracamposocultos="";
      include($rutxx."../../incluidos_modulos/botones.modificar.php");
    ?>
</nav>


</form>

</section>





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

