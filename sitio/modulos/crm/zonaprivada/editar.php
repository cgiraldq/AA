<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();

$titulomodulo="Configuracion de Clientes";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblregistro_zonaprivada";
$rutaImagen="../../../contenidos/images/funcionarios/";


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsapellidos=$_REQUEST['dsapellidos'];
			$dsm=$_REQUEST['dsm'];
			$dstelefono=$_REQUEST['dstelefono'];
			$dscorreocliente=$_REQUEST['dscorreocliente'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsciudad=$_REQUEST['dsciudad'];
			$dspais=$_REQUEST['dspais'];
			$dstipo=$_REQUEST['dstipo'];
			$dsdireccion=$_REQUEST['dsdireccion'];
			$dscontrasena=$_REQUEST['dscontrasena'];
			$clavee = $rc4->encrypt($s3m1ll4, $dscontrasena);
			$clave = urlencode($clavee);
			$dsusuario=$_REQUEST['dsusuario'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {


					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dstelefono='$dstelefono'";
					$sql.=" ,dscorreocliente='$dscorreocliente'";
					$sql.=" ,dsciudad='$dsciudad'";
					$sql.=" ,dsapellidos='$dsapellidos'";
					$sql.=" ,dsdireccion='$dsdireccion'";
					$sql.=" ,dspais='$dspais'";
					$sql.=" ,dstipo='$dstipo'";

					$sql.=",dscontrasena='$clave'";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					//exit;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../funcionarios/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
						$mensajes=$men[7];
					}
					}





?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
		include($rutxx."../../incluidos_modulos/core.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idactivo,a.dstelefono,a.dscorreocliente,a.dscontrasena,a.dsciudad,a.dsdireccion,a.dspais,a.dstipo,a.dsapellidos";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idactivo=$result->fields[1];
$dstelefono=$result->fields[2];
$dscorreocliente=$result->fields[3];
$dsclave=$result->fields[4];
$dscontrasena = $rc4->decrypt($s3m1ll4, urldecode($dsclave));
$dsciudad=$result->fields[5];
$dsdireccion=$result->fields[6];
$dspais=$result->fields[7];
$dstipo=$result->fields[8];
$dsapellidos=$result->fields[9];


?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<?



$titulocampo="Tipo";
$valores="1-SEÑORA;2-SEÑOR";
$campo="dstipo";
$valorcampo=$dstipo;
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");


$titulocampo="Nombre ";
$campo="dsm";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsm;
$mensaje_capa="Debe ingresar  la pagina";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Apellido";
$campo="dsapellidos";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsapellidos;
$mensaje_capa="Debe ingresar un Teléfono";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Teléfono";
$campo="dstelefono";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dstelefono;
$mensaje_capa="Debe ingresar un Teléfono";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Correo";
$campo="dscorreocliente";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dscorreocliente;
$mensaje_capa="Debe ingresar un Teléfono";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Dirección";
$campo="dsdireccion";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsdireccion;
$mensaje_capa="Debe ingresar un Dirección";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Ciudad";
$campo="dsciudad";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsciudad;
$mensaje_capa="Debe ingresar un Ciudad";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="País";
$campo="dspais";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dspais;
$mensaje_capa="Debe ingresar un País";
$tipocampo=1;
include($rutxx."../../incluidos_modulos/control.texto.php");

$titulocampo="Contraseña";
$campo="dscontrasena";
$contrasena="dscontrasena";
$contadorx="counter_$campo";
$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dscontrasena;
$mensaje_capa="Debe ingresar una Contrasena";
$tipocampo=6;
include($rutxx."../../incluidos_modulos/control.texto.php");


$titulocampo="Activar";
$valores="1-SI;2-NO;";
$campo="idactivo";

$valorcampo=$idactivo;
$tipocampo=3;
include($rutxx."../../incluidos_modulos/control.texto.php");

?>

</table>

<?
			$forma="u";
			$param="dsm";
			include($rutxx."../../incluidos_modulos/botones.modificar.php");
		?>
		<input type="hidden" name="idx" value="<? echo $idx?>">
</form>

</td>
</tr>
</table>



<?
} // fin si
$result->Close();
?>

<? include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
