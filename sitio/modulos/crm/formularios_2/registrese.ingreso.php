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
// Tabla de uso para el ingreso de datos
$tituloforma="Ingreso de nuevo registro";
echo "<br>";
include("../../incluidos_modulos/formas.encabezado.php");

$titulocampo="Nombre";
$campo="dsm";
$contadorx="counter_$campo";

$tam=60;$valorx="255";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsm;
$mensaje_capa="Debe ingresar el nombre";
$tipocampo=1;
include("../../incluidos_modulos/control.texto.php");

$titulocampo="Posici&oacute;n";
$campo="idpos";
$contadorx="counter_$campo";
$tam=1;$valorx="8";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$idpos;
$mensaje_capa="Debe ingresar la posicion";
$tipocampo=1;
include("../../incluidos_modulos/control.texto.php");

$titulocampo="Activar";
$valores="1-SI;2-NO;";
$campo="idactivo";
$valorcampo=$idactivo;
$tipocampo=3;
include("../../incluidos_modulos/control.texto.php");
?>
<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,idpos";
include("../../incluidos_modulos/formas.remates.php");
?>