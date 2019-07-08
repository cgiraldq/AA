<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
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
// edicion de datos
$pasar=1; // muestra el inyecion pero lo deja pasar
include("../../incluidos_modulos/globales.php");
$apagar=1;
$titulomodulo="Configuracion de detalle de cliente registrado";
$rr="registrese.php";
$idx=$_REQUEST['idx'];
$tabla=$prefix."tbltiposformulariosxregistrosxregistro";


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

					if ($dsclave<>$dsclaveant) $sql.=",dscontrasena=sha1('$dsclave') ";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$i_dsnombre." modifico un registro numero $idx ";
						$dsruta="../formularios/registrese.php";

						$mensajes=$funciones->ejecucionesSQL($sql,$dstitulo,$dsdesc,$dsruta,$titulomodulo,3);

					}


include("../../incluidos_modulos/html.encabezado.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idactivo,a.dstelefono,a.dscorreocliente,a.dscontrasena,a.dsciudad,a.dsdireccion,a.dspais,a.dstipo,a.dsapellidos";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/core.principal.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='registrese.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idactivo=$result->fields[1];
$dstelefono=$result->fields[2];
$dscorreocliente=$result->fields[3];
$dsclave=$result->fields[4];
$dscontrasena = $dsclave;
$dsciudad=$result->fields[5];
$dsdireccion=$result->fields[6];
$dspais=$result->fields[7];
$dstipo=$result->fields[8];
$dsapellidos=$result->fields[9];

$tituloforma="Edicion del registro seleccionado";
include("../../incluidos_modulos/formas.encabezado.php");



$titulocampo="Tipo";
$valores="1-Sr;2-Sra;";
$campo="dstipo";
$valorcampo=$dstipo;
$tipocampo=3;
include("../../incluidos_modulos/control.texto.php");


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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");

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
include("../../incluidos_modulos/control.texto.php");


$titulocampo="Activar";
$valores="1-SI;2-NO;";
$campo="idactivo";

$valorcampo=$idactivo;
$tipocampo=3;
include("../../incluidos_modulos/control.texto.php");

$forma="u";
$param="dsm";
$botonmodificar=1;
include("../../incluidos_modulos/formas.remates.php");
echo "<br>";

} // fin si
$result->Close();
include("../../incluidos_modulos/html.remate.php");?>
