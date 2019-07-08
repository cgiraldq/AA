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
buscador generico 
por letras
por parametros
*/
?>
<br />

  <table width="80%" cellspacing="5" cellpadding="0" class="text1">
  <form method="post" name="buscador_superior" action="<? echo $pagina?>?dspagina=<? echo $dspagina?>&idpregunta=<? echo $idpregunta?>&dsreferente=<? echo $dsreferente?>&dsafiliado=<? echo $dsafiliado ?>&entidad=<? echo $entidad ?>">
  <tr>
  <td colspan="2"> <img src="../../img_modulos/modulos/zoom_g.gif" align="absmiddle" border="0">
  Buscar:
  <select name="buscar" class="textnegro">
  <option value="Afiliado">Afiliado</option>
  <option value="Beneficiario">Beneficiario</option>
  </select>
  Tipo de Documento
  <select name=campo class=textnegro>
		  <option value="4">Cedula Extranjeria</option>
		  <option value="2">Cedula Ciudadania</option>
		  <option value="5">NIU</option>
		  <option value="6">Pasaporte</option>
		  <option value="7">Tarjeta Extranjeria</option>
		  <option value="1">Tarjeta Identidad</option>
		  <option value="3">Registro Civil</option>
	</select>
	&nbsp;Numero Documento
  <input type="text" name="param" class="textnegro" size="25" maxlength="255">	
  <input type="submit" name="enviar" value="Buscar" class="text1">
  
  </td>
  </tr>
  </form>
 </table>