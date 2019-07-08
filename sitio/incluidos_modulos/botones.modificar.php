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
Botoneria generica de modificacion
*/
$tiny="Activar editor de texto";
$validacion="valU('$forma','$param')";
if($mod==1){
	$modificar="Modificar Calendario";
	$validacion="ira('$rutaact')";
}
elseif($mod==2)$modificar="Modificar Datos";
else $modificar="Modificar";
?>
<input type=button name=enviar value="<? echo $modificar?>"  class="botones" onClick="<? echo $validacion;?>">
<? if($mod==2 && $anho=="" && $idf==""){?> 
<input type=button name=enviar value="Modificar Calendario" id="botoncalendario"  class="botones" onClick="mostrarcalendario();">
<? }?>
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">
<? if($mod<>1){?>
<input type="hidden" name="paso" value="1">
<input type="hidden" name="idc" value="<? echo $idc?>">
<? }?>


<?if($activareditor==1){?>
<input type="button" name="tiny[]" id="tiny[]" value="<? echo $tiny;?>"  class="botones" onclick="validar_tiny('<? echo $forma?>');">
<?}?>


