<?
/*
CF-INFORMER
ADMINISTRADOR DE CONTENIDOS

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
 Validacion de datos al ingresar y manejo de perfiles
*/
session_start();
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/modulos.funciones.php");

$idproducto=$_REQUEST['idproducto'];
$idproducto=trim($idproducto);
$idtalla=$_REQUEST['idtalla'];
		if($idtalla<>""){

			$tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],2);
	   		$data="<ul class='cont_colores'>";
	   		$data.="<h3>COLORES:</h3>";
	   		$data.="<select  name='idcolor' id='idcolor' style='width:110px;'  onclick='ocultar(mensaje)' onchange='valor_color(mensaje)'> ";
			$data.="<option value=''>--Seleccione--</option>";
			$sqlx="select a.id,a.dsm,a.dsd,b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5,c.iva,c.dsflete,c.dsreferencia,b.dsunidad";
			$sqlx.=" FROM ecommerce_tblcolores a, ecommerce_tbltallasxtblproductos b ,ecommerce_tblproductos c";
			$sqlx.=" where a.id=idcolor and b.iddestino=$idtalla and b.idorigen=$idproducto and c.id=b.idorigen and a.idactivo not in (2,9) and b.dsunidad > 1  ";
			$tipocliente=seldato("idtipocliente","id"," tblclientes",$_SESSION['i_idcliente'],2);
                      if($tipocliente==2) {
                      $xprecio=2;
                      }elseif($tipocliente==3){
                        $xprecio=3;
                      }elseif($tipocliente==4){
                        $xprecio=4;
                      }elseif($tipocliente==5){
                        $xprecio=5;
                      }else{
                        $xprecio=1;
                      }
               
			$vermas_c=$db->Execute($sqlx);
	   		if(!$vermas_c->EOF){
	   		while (!$vermas_c->EOF) {
	   		$idcolor=$vermas_c->fields[0];
	   		$dsmcolor=$vermas_c->fields[1];
	   		$dscolor=$vermas_c->fields[2];
	   		$dsporiva=$vermas_c->fields[8];// porcentaje impuesto
	   		//$dsflete=$vermas_c->fields[9];
	   		$dsflete=0;
	   		$dsreferencia=$vermas_c->fields[10];
	   		$id=$idproducto;
	   		            $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$idproducto or dsref='$dsreferencia')";
                        $sqldes.=" and b.idorigen=a.id ";
                        //echo "<br>".$sqldes."<br>--productos";
                        $result_des=$db->Execute($sqldes);
                        if(!$result_des->EOF){
                        $xpromoproducto=1;
                        $promodescuento=($result_des->fields[1]);
                        $idprecio=($result_des->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','tbltblproductoxcategoria',$id,1)."'";
                        //echo "<br>".$sqldes."<br>--Categoria";
                        $resultY=$db->Execute($sqldes);
                        if(!$resultY->EOF){
                        $xpromocatecoria=1;
                        $promodescuento=($resultY->fields[1]);
                        $idprecio=($resultY->fields[2]);
                        }else{
                        $sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.=" ecommerce_tblpromocionesxsubcategoria b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
                        $sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and b.idorigen=a.id ";
                        $sqldes.=" and b.iddestino='".seldato('iddestino','idorigen','ecommerce_tblsubcategoriaxtblproducto',$id,1)."'";
                        //echo $sqldes."<br>--Sub";
                        $resultx=$db->Execute($sqldes);
                        if(!$resultx->EOF){
                        $xpromosubcategoria=1;
                        $promodescuento=($resultx->fields[1]);
                        $idprecio=($resultx->fields[2]);
                        }$resultx->Close();//  Fin Subcategoria
                        }$resultY->Close();// Fin  promocion Categoria
                        }$result_des->Close();// Fin  promocion producto





	   		if($tipocliente==2){
	   		$precio=$vermas_c->fields[4];
	   		$preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
	   		$iva=($precio*($dsporiva/100));
	   		$preciox1=number_format($precio+$dsflete+$iva+$valorseguro,0); // Valores con  formato para mostrar
	   		$preciox2=($precio+$dsflete+$iva+$valorseguro);// valores sin formato para  guardar en la tabla
	   		}elseif($tipocliente==3){
	   		$precio=$vermas_c->fields[5];
	   		$preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
	   		$iva=($precio*($dsporiva/100));
	   		$preciox1=number_format($precio+$dsflete+$iva+$valorseguro,0); // Valores con  formato para mostrar
	   		$preciox2=($precio+$dsflete+$iva+$valorseguro);// valores sin formato para  guardar en la tabla
	   		}elseif($tipocliente==4){
	   		$precio=$vermas_c->fields[6];
	   		$preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
	   		$iva=($precio*($dsporiva/100));
	   		$preciox1=number_format($precio+$dsflete+$iva+$valorseguro,0); // Valores con  formato para mostrar
	   		$preciox2=($precio+$dsflete+$iva+$valorseguro);// valores sin formato para  guardar en la tabla
	   		}elseif($tipocliente==5){
	   		$precio=$vermas_c->fields[7];
	   		$preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
	   		$iva=($precio*($dsporiva/100));
	   		$preciox1=number_format($precio+$dsflete+$iva+$valorseguro,0); // Valores con  formato para mostrar
	   		$preciox2=($precio+$dsflete+$iva+$valorseguro);// valores sin formato para  guardar en la tabla
	   		}else{
	   		$precio=$vermas_c->fields[3];
	   		$preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
	   		$iva=($precio*($dsporiva/100));
	   		$preciox1=number_format($precio+$dsflete+$iva+$valorseguro,0);
	   		$preciox2=($precio+$dsflete+$iva+$valorseguro);// valores sin formato para  guardar en la tabla
	   		}


	   		
            $preciodescuento_f=number_format($preciodescuento,0);

	   		$preciox=$idcolor."|".$preciox1."|".$preciox2."|".$preciodescuento_f."|".$preciodescuento."|".$vermas_c->fields[11];

	   		$data.="<option value='$preciox' >".reemplazar($dsmcolor)."</option>";
	   		/*$data.="
	   		<li>
				<input type='radio' name='idcolor' id='idcolor' onclick='valor_color(mensaje)'  title='$dsmcolor' value='$preciox'>
				<span title='$dsmcolor' style='background:$dscolor'></span>
			</li>
			 ";*/
	   		$vermas_c->MoveNext();
			}
	   		}$vermas_c->Close();
	   		
	   		$data.="</select>

	   		</ul>";
	   		}else{
 	 			$data="-1";
 	 		}
include("../../incluidos_modulos/cerrarconexion.php");


echo $data;