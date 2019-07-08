<?
$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario

$rc4 = new rc4crypt();
$apagar=1;
if($_REQUEST['idy']<>"")$ideditar=2;
$mensajes=$men[1];
$titulomodulo="Registro rapido";
$idgestion=$_REQUEST['idgestion'];
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='registro.rapido.php' class='textlink'>$titulomodulo</a>  / <span class='text1'>Datos guardados con exito</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="98%" border="0" cellpadding="0" cellspacing="0" class="campos_ingreso" >
        <tr>
         	<td align="left" valign="middle">
                <strong>Estos son los datos registrados</strong>: 
<?
 $sql="SELECT a.id,a.idcliente,a.dsd,a.dsfechal,b.nombre_o_razn_social,b.apellido_o_nombre_comercial,a.idactivo,a.dsfechallamada";
 $sql.=",a.idregistra,a.idmotivo,a.usuario";
 $sql.=" FROM framecf_tblgestionesxusuario a, crm_clientes b WHERE ";
  $sql.=" a.id='".$_REQUEST['idgestion']."' and b.id=a.idcliente ";
  //echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {

            $id=$result->fields[0];
            $cliente=$result->fields[1];
            $dsd=$result->fields[2];
            $fecha=$result->fields[3];
            $nombre=$result->fields[4];
            $apellido=$result->fields[5];
            $estado=$result->fields[6];
            $fechallamada=$result->fields[7];
            $idregistra=$result->fields[8];
            $dsregistra=seldato("b.dsm","b.id"," tblusuarios b ",$idregistra,1);
            if ($idregistra==999) $dsregistra="Sitio Web";
            if ($idregistra=='1') $dsregistra="Administrador ";
            $idmotivo=$result->fields[9];
            $dsmotivo=seldato("b.dsnombre","b.id"," crmtblmotivos b ",$idmotivo,1);
            $usuario=$result->fields[10];
            $dsusuario=seldato("b.dsm","b.id"," tblusuarios b ",$usuario,1);
        
            echo "<br><br><strong>Cliente:</strong> ".$nombre." ".$apellido."<br>";
            echo "<strong>Motivo Llamada:</strong> ".$dsmotivo."<br>";
            echo "<strong>Descripcion llamada:</strong> ".$dsd."<br>";
            echo "<strong>Fecha llamada:</strong> ".$fechallamada."<br>";
            echo "<strong>Usuario registra:</strong> ".$dsregistra."<br>";
            echo "<strong>Usuario Asignado:</strong> ".$dsusuario."<br>";


        }
        $result->Close();
            
?>

         	</td>
        </tr>

</table>

<form action="#" method=post id="u" name="u">


<tr>
  <td align="center" colspan="4">
<input type="button" name="enviar" value="REGRESAR" class="botones" onclick="irAPaginaD('registro.rapido.php?idxx=<? echo $_REQUEST['idx'];?>')">
 </td>
</tr>


</table>





<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

<?include("../formularios/formulario.direcciones.php");?>


