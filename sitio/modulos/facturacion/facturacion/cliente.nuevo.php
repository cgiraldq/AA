<?
/*
| ----------------------------------------------------------------- |
MEGAPINTURAS LTDA
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores: 
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>

=====================================================================
| ----------------------------------------------------------------- | 
Tabla generica de carga de datos de cliente y proveedor
*/
if ($idactivox=="")  $idactivox=1;?>

			<table width="100%" cellspacing="1" cellpadding="2"  class="text1" ID="Table2" bgcolor="<? echo $fondos[9]?>" >
			<tr align="center" class="textnegrotit" bgcolor="<? echo $fondos[3];?>">
			<td  align="center" colspan="8" class="text_blanco">Cliente nuevo&nbsp;
			
			</td>
			</tr>
			
			<tr align="center" bgcolor="<? echo $fondos[3];?>">
			<td  align="left"><p>Tipo De Identificacion</p></td>
			<td  align="left">
				<input type="text" name="dstiponuevo" class="forma2" value="<? echo $dstiponuevo;?>" size="10" maxlength="20" onKeypress="moverfoco(1,'dsnitnuevo',0)">
			</td>
			<td  align="left"><p>Identificacion</p></td>
			<td  align="left">
				<input type="text" name="dsnitnuevo" class="forma2" value="<? echo $dsnitnuevo;?>" size="10" maxlength="20" onKeypress="moverfoco(1,'dsnombrenuevo',0)">
			</td>
			

			<td  align="left"><p>Nombres</p></td>
			<td  align="left"><input type="text" name="dsnombrenuevo" class="forma2" value="<? echo $dsnombrenuevo;?>" size="20" maxlength="255" onKeypress="moverfoco(1,'dsapellidosnuevo',0)"></td>


			<td align="left"><p>Apellidos</P></td>
			<td align="left"><input type="text" name="dsapellidosnuevo" class="forma2" value="<? echo $dsapellidosnuevo;?>" size="10" maxlength="20" onKeypress="moverfoco(1,'dsdirnuevo',0)"></td>

			</tr>


<tr align="center" bgcolor="<? echo $fondos[3];?>">
<td align="left"><p>Direccion</p></td>
<td align="left"><input type="text" name="dsdirnuevo" class="forma2" value="<? echo $dsdirnuevo;?>" size="10" maxlength="20" onKeypress="moverfoco(1,'dstelnuevo',0)"></td>

<td align="left"><p>Telefono</p></td>
<td align="left"><input type="text" name="dstelnuevo" class="forma2" value="<? echo $dstelnuevo;?>" size="10" maxlength="20" onKeypress="moverfoco(1,'dsemial',0)"></td>

<td align="left"><p>E-mail</p></td>
<td align="left"><input type="text" name="dsemail" class="forma2" value="<? echo $dsemail;?>" size="10" maxlength="50" onKeypress="moverfoco(1,'dsdirnuevo',0)"></td>



<td align="left">&nbsp;</td>
<td align="left">
<input type=button name=enviary value="Guardar" class="botones_factura" onClick="guardarcliente();">
<input type=button name=enviar value="Cancelar" class="botones_factura" onClick="capacliente('<? echo $capa?>',2)">
<div id="validacion_nuevo_cliente"></div>
<input type="hidden" name="idactivox" value="<? echo $idactivox?>">
</td>

</tr>
</table>
