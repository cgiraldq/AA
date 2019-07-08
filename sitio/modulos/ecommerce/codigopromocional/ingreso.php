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
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>
<?
$titulocampo="Cantidad ";
$campo="idcant";
$contadorx="counter_$campo";
$tam=20;$valorx="30";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$idcant;
$mensaje_capa="Debe ingresar la Cantidad";
$tipocampo=1;
include("../../../incluidos_modulos/control.texto.php");?>
<?
$titulocampo="Activar";
$valores="1-GENERAL ;2-CODIGO UNICO";
$campo="idactivo";
$valorcampo=$idactivo;
$tipocampo=3;
include("../../../incluidos_modulos/control.texto.php");
?>
<?
$titulocampo="Digite el % descuento ";
$campo="dsdescuento";
$contadorx="counter_$campo";
$tam=20;$valorx="3";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsdescuento;
$mensaje_capa="Debe ingresar el % de descuento";
$tipocampo=1;
include("../../../incluidos_modulos/control.texto.php");?>
<?
$titulocampo=" Digite el % descuento cuando el codigo se ha vencido";
$campo="dsdescuentov";
$contadorx="counter_$campo";
$tam=20;$valorx="3";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsdescuentov;
$mensaje_capa="Debe ingresar el % de descuento";
$tipocampo=1;
include("../../../incluidos_modulos/control.texto.php");?>
<?
$titulocampo="Fecha Inicial";
$campo="dsfechai";
$contadorx="counter_$campo";
$tam=20;$valorx="3";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsfechai;
$mensaje_capa="Debe ingresar fecha inicial";
$tipocampo=5;
include("../../../incluidos_modulos/control.texto.php");?>

<?
$titulocampo="Fecha Final";
$campo="dsfechaf";
$contadorx="counter_$campo";
$tam=20;$valorx="3";
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$dsfechaf;
$mensaje_capa="Debe ingresar fecha final";
$tipocampo=5;
include("../../../incluidos_modulos/control.texto.php");?>
<?
$titulocampo="Patrocinador";
$campo="iddistribuidor";
$contadorx="counter_$campo";
$valorcampo=$iddistribuidor;
$formax="u";
$campox="$campo";
$nombre_capa="capa_$campo";
$valorcampo=$iddistribuidor;
$tablax="ecommerce_tblpatrocinadores";
$tipocampo=7;
$mensaje_capa="Seleccione un Patrocinador";
include("../../../incluidos_modulos/control.texto.php");?>

<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="idcant,idactivo,dsdescuento,dsdescuentov,dsfechai,dsfechaf,iddistribuidor";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>