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
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado 
$nombrecampos="Secci&oacute;n";
include("../../incluidos_modulos/tabla.encabezado.php");
/*$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}*/
		if($_SESSION['i_idperfil']==4){
		$sql="select a.id,a.dsm,a.dsr from tblmodulos a inner join tblusuariosxtblmodulos b on b.iddestino=a.id and b.idorigen=".$_SESSION['i_idusuario'];
		$sql.=" where a.idactivo=3 and a.id in(51,52,53,54,55,109,110) ";
		}else{
		$sql="select a.id,a.dsm,a.dsr from tblmodulos a where a.idactivo=3 and a.id in(51,52,53,54,55,109,110)"; 
		}
		$sql.=" order by a.dsm asc ";
		//echo $sql;
		 $result = $db->Execute($sql);
		  while (!$result->EOF) {
		  $idm=$result->fields[0];
		  $dsm=$result->fields[1];
		  $rutam=$result->fields[2];
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  
		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>
			
		  <td align="center">
			<?
		   $rutax=$rutam;
		   include("../../incluidos_modulos/enlace.detalles.php");?>
		   </td>	
			
		 </tr>
		  <? 
		   $result->MoveNext();
		   }
		  ?>
			
	
		<?
		//$contar++;
		//$result->MoveNext();
	//} // fin while 
?>
<!--<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr>-->
</form>

</table>
