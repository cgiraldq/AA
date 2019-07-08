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
 Archivo Generico de buscador
*/

?>
 <table width="90%" cellspacing="5" cellpadding="0" class="text1" border=0 align="center">
		<form action="<? echo $_SERVER['PHP_SELF'];?>#<? echo $name;?>" method=post name=buscar>    
             <tr bgcolor="<? echo $fondos[4];?>">
			 <td >
			 <?
			 if ($verr==1){
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaD";
					$prop="'";				
			 } else { 
				if ($pagina=="actividades.php"){	
					$redir[0]="editactividades.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";												
					$prop="'";						
				}else if ($tabla=="tblempresa"){
					$redir[0]="innempresa.php";
					$redir[1]="";
					$redir[2]="";
-					$rutaP="irAPaginaDN";													
					$prop="','800','800'";
				} elseif ($tabla=="tblistas"){	
					$redir[0]="innlista.php";
					$redir[1]="";
					$redir[2]="explista.php";
					$rutaP="irAPaginaD";				
					$prop="'";				
				} elseif ($tabla=="tblcontenidos"){	
					$redir[0]="innc.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaD";				
					$prop="'";				
				} elseif ($tabla=="tblmensajes"){	
					$redir[0]="innm.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaD";												
					$prop="'";	
				} elseif ($tabla=="tblprogramas"){	
					$redir[0]="editprogramas.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";												
					$prop="'";	
				} elseif ($tabla=="tblvideos"){	
					$redir[0]="editvideos.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";												
					$prop="'";	
				} elseif ($tabla=="tblesalud"){	
					$redir[0]="innesalud.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaD";
					$prop="'";
				} elseif ($tabla=="tbldfestivos"){	
					$redir[0]="inndf.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";						
				} elseif ($tabla=="tblnoticias"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";				
				} elseif ($tabla=="tbltareas"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";				
				} elseif ($tabla=="tblnovedades"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";				
				} elseif ($tabla=="tblasoc"){	
					$redir[0]="innasoc.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";
				} elseif ($tabla=="tblusuariose"){	
					$redir[0]="innusuariosempresa.php";
					$redir[1]="";
					$redir[2]="../reportes/listausuarios.php";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblclientes"){	
					if ($idinn==1){
						$redir[0]="../terceros/innclientes.php";
					} else { 
						$redir[0]="";
					}
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblproveedores"){	
					if ($idinn==1){
						$redir[0]="../proveedores/innclientes.php";
					} else { 
						$redir[0]="";
					}
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";


				} elseif ($tabla=="tblconcepto"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";		


				} elseif ($tabla=="ecommerce_tblfacturase"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";		
				} elseif ($tabla=="ecommerce_tblfacturasepv"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";		

					
				} elseif ($tabla=="tblcomprase"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";							
								
				} elseif ($tabla=="tblfcolorese"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";					
				} elseif ($tabla=="tblfordenese"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";					

				} elseif ($tabla=="tblfpedidose"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";					

				} elseif ($tabla=="tblfinventarioe"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";					
					
					
				} elseif ($tabla=="tblproyectos"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";					
				} elseif ($tabla=="tblciclos"){	
					$redir[0]="innciclo.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";								
				} elseif ($tabla=="tblcajadiaria"){	
					$redir[0]="inncajadiaria.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','800'";								
					
				} elseif ($tabla=="tblproductos"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblempresa" && $listem==1){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblpreguntasmanual"){	
					$redir[0]="innpregunta.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblrecibos"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblrecibospv"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";
				} elseif ($tabla=="tblremisione"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";						
					
				} elseif ($tabla=="tblegresos"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
					
				} elseif ($tabla=="tblnotasxcredito"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tblsoporte"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	

				} elseif ($tabla=="tblnotasce"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tblegresose"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	

				} elseif ($tabla=="tblactividadese"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tblactividadesc"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tbldocumentos"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tblpromocionales"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	
				} elseif ($tabla=="tblapps"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	

				} elseif ($tabla=="tblsice"){	
					$redir[0]="";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaDN";													
					$prop="','800','600'";	

					
				} elseif ($pagina=="configurar.php"){	
					$redir[0]="innconfigurar.php";
					$redir[1]="";
					$redir[2]="";
					$rutaP="irAPaginaD";
					$prop="'";		

					
				 } else { 
					$redir[0]="innconfigurar.php";
					$redir[1]="impconfigurar.php";
					$redir[2]="expconfigurar.php";
					$rutaP="irAPaginaD";
					$prop="'";
				 }
			 } // fin de verr 
			 ?>
 			
			 
			 <? if ($redir[0]<>""){?>
				 <input type=button name=enviar value="Ingresar" class="formbt2" onclick="<? echo $rutaP;?>('<? echo $redir[0];?>?idprog=<? echo $idprog;?>&dsprog=<? echo $dsprog;?>&tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&name=<? echo $name;?>&tipo=<? echo $tipo;?>&idactivo=<? echo $idactivo;?><? echo $prop;?>);">
			 <? } ?>
			 <? if ($redir[1]<>""){?>
				 <input type=button name=enviar value="Importar" class="formbt2" onclick="irAPaginaD('<? echo $redir[1];?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&name=<? echo $name;?>');">
			 <? } ?>
 			 <? if ($redir[2]<>""){?>
				 <input type=button name=enviar value="Exportar" class="formbt2" onclick="irAPaginaD('<? echo $redir[2];?>?tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&name=<? echo $name;?>');">
			 <? } ?>	

			 		 
			 </td>
                <td valign=middle >
				 <? if ($tabla=="tblproductos"){?>
			 Categoria:
			 <select name="idtprx" class="textnegro1">
			 <option value="">Seleccione....</option>
			<? combotipop($_REQUEST['idtprx'],$_SESSION['i_idempresa'],1);?>
			</select>
			
			 Grupo:
			 <select name="idgrupox" class="textnegro1">
			 <option value="">Seleccione....</option>
			<? combogrupos($_REQUEST['idgrupox'],$_SESSION['i_idempresa'],1);?>
			</select>
			 SubGrupo:
			 <select name="idsubgrupox" class="textnegro1">
			 <option value="">Seleccione....</option>
			<? combosubgrupos($_REQUEST['idgrupox'],$_SESSION['i_idempresa'],1);?>
			</select>
			
			
			 <? } ?>
			 
		 <? if ($tabla=="tblproyectos"){?>
			 Listar por:
			 <select name="idtpro" class="textnegro1">
			 <option value="">Seleccione....</option>
			<? combotipoproy($_REQUEST['idtpro'],$_SESSION['i_idempresa'],1);?>
			</select>
			 <? } ?>


		 
		 <? if ($tabla=="tblclientes"){?>
			 Por lista de precios:
			 <select name="idlistax" class="textnegro1">
			 <option value="">...</option>
			<? combostipoprecios($idlistax,$_SESSION['i_idempresa'],0);?>
			</select>
			
			<!--
			 Por tipo de cliente:
			<select name="idorigenclienteX" class=textnegro1>
					<option value="">...</option>
					<? //	combosorigencliente($idorigenclienteX,$_SESSION['i_idempresa']);?>
					</select> 			
				-->	
			 <? } ?>


			 
				
				Buscar por <input type=text name=param class="textnegro1" size=20 value="<? echo $_REQUEST['param'];?>"></td>
                <td align=left>
                EN
                <select name=campo class="textnegro1">
					<? for ($i=0;$i<=count($codigos)-1;$i++){
						if ($codigos[$i]==$_REQUEST['campo']){
							$check="selected";
						} else { 
							$check="";
						}
					?>
						<option value="<? echo $codigos[$i];?>" <? echo $check;?>><? echo $nombres[$i];?></option>
					<? } ?>
				</select>


		
				
<? if ($tabla=="ecommerce_tblfacturase" || $tabla=="tblsoporte" || $tabla=="tblrecibos" || $tabla=="tblrecibospv"  || $tabla=="tblremisione" || $tabla=="tblcomprase"  || $tabla=="tblnotasxcredito" || $tabla=="tblfinventarioe" || $tabla=="tblegresose" || $tabla=="tblnotase") {?>
		
		<? if ($mostrarestadossoporte==1) { ?>
		Estado Soporte:
					<select name="idactivox2" class=textnegro1>
<option value="">.......</option>
<option value="Todos" <? if ($idactivox2=="Todos") echo "SELECTED";?>>Todas</option>
<option value="0" <? if ($idactivox2=="0") echo "SELECTED";?>>Abierto</option>
<option value="1" <? if ($idactivox2=="1") echo "SELECTED";?>>en Proceso</option>
<option value="2" <? if ($idactivox2=="2") echo "SELECTED";?>>Anulado</option>
<option value="3" <? if ($idactivox2=="3") echo "SELECTED";?>>Cerrado</option>
					</select>
<? } ?>			



				<? if ($mostrarestados==1) { ?>
				Estado:
					<select name="idactivox1" class=textnegro1>
<option value="">.......</option>
<option value="Todos" <? if ($idactivox1=="Todos") echo "SELECTED";?>>Todas</option>
<option value="0" <? if ($idactivox1=="0") echo "SELECTED";?>>Facturada</option>
<option value="1" <? if ($idactivox1=="1") echo "SELECTED";?>>Abonando</option>
<option value="2" <? if ($idactivox1=="2") echo "SELECTED";?>>Cancelada</option>
<option value="3" <? if ($idactivox1=="3") echo "SELECTED";?>>Anulada</option>
					</select>
<? } ?>			





Año:
<input name="idaniox" type="text" class="forma" size="4" value="<? echo $idaniox?>" tabindex=3 /> / 
Mes:						
						<select name=idmesx class="forma" tabindex=4>
						<option value="">---</option>
						<? for ($i=1;$i<=12;$i++) {
							$i1=$i;
							if ($i<10) $i1="0".$i;
							?>
						<option value="<? echo $i1?>" <? if ($i1==$idmesx) echo selected?>><? echo $i1?></option>
						<? } ?>
						</select>

/ Dia:					 

<select name=iddiax class="forma" tabindex=4>
						<option value="">---</option>
						<? for ($i=1;$i<=31;$i++) {
							$i1=$i;
							if ($i<10) $i1="0".$i;
							?>
						<option value="<? echo $i1?>" <? if ($i1==$iddiax) echo selected?>><? echo $i1?></option>
						<? } ?>
						</select>


				<? } ?>
			




				<input type=hidden name=tabla value="<? echo $tabla;?>">
				<input type=hidden name=dir value="<? echo $dir;?>">				
				<input type=hidden name=idtipo value="<? echo $idtipo;?>">				
				<input type=hidden name=name value="<? echo $name;?>">			
				<input type=hidden name=cargarfac value="<? echo $cargarfac;?>">	
				<input type=hidden name=cargarec value="<? echo $cargarec;?>">					
				<input type=hidden name=poscampo value="<? echo $poscampo;?>">					
				<input type=hidden name=dscampo value="<? echo $dscampo;?>">					

				<input type=hidden name=enca value="<? echo $enca;?>">					
										
			
                &nbsp; <input type=submit name=enviar value="Buscar" class=formbt2>
<? if ($tabla=="ecommerce_tblfacturase") {?>
	<input type=submit name=exportar value="Exportar A2" title="Click para exportar A2. Seleccione el mes y el a&ntilde;o y presione este boton" class=formbt2>
<? } ?>
                </td>
              
               </tr> 
			 <? if ($bloqueabc<>"1"){?>  
			<tr bgcolor="<? echo $fondos[4];?>" >
                <td align=center colspan=5 class="text1">       
                <table cellspacing="0" cellpadding="0" border="0" align=center width=100%>
				<tr valign="top" bgcolor="<? echo $fondos[4]?>" >
				<?
				$i=0;
				$partir=explode(",",$vector);
				$contador=count($partir);
				for ($i=0;$i<=$contador;$i++){
				?>
					<td align=center width="3%" >
							<a class="texboton2" href="<? echo $_SERVER['PHP_SELF'];?>?dscampo=<? echo $dscampo?>&poscampo=<? echo $poscampo?>&letra=<? echo $partir[$i];?>&tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idempresa=<? echo $idempresa;?>&cargarfac=<? echo $cargarfac?>&cargarec=<? echo $cargarec?>&v=<? echo $v;?>&enca=<? echo $enca;?>" TITLE="<? echo $mem[28]." ".$partir[$i];?>"><? echo $partir[$i];?></a>
					</td>
				<? } ?>
				<td align=center width="3%">
						<a class="texboton2" title="<? echo $mem[26];?>" href="<? echo $_SERVER['PHP_SELF']; ?>?dscampo=<? echo $dscampo?>&poscampo=<? echo $poscampo?>&letra=XX&tabla=<? echo $tabla;?>&dir=<? echo $dir;?>&idempresa=<? echo $idempresa;?>&cargarfac=<? echo $cargarfac;?>&cargarec=<? echo $cargarec?>&v=<? echo $v;?>&enca=<? echo $enca;?>">Todos</a>
				</td>
				
				 <td width="11%" align=center  bgcolor="#efefef" class="textnegro1">
                <?
				if ($_REQUEST['letra']=="XX"){ 
					echo "Listando Todos los datos";
				}elseif($_REQUEST['letra']=="" && $_REQUEST['param']=="") {
					echo "Listando datos";
				}elseif($_REQUEST['letra']<>"XX" && $_REQUEST['param']=="") {
					 echo " Buscando por letra ".$_REQUEST['letra'];
				}elseif($_REQUEST['letra']=="" && $_REQUEST['param']<>"") {
					 echo " Buscando por <u>".$_REQUEST['param']."</u> ";
				} 
				?>	
                </td>
				
				</tr>
				</table>		
                </td>
              </tr>
			<? } ?>  
	</form>              
    </table>
<br>