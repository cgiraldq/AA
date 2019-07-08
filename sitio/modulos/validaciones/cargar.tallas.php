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
			//$db->debug=true;
			$sql ="select a.id,a.dsm,b.dsprecio1,b.dsprecio2,b.dsprecio3,b.dsprecio4,b.dsprecio5,c.iva,c.dsflete,c.dsreferencia";
			$sql.=" FROM ecommerce_tbltallas a,ecommerce_tbltallasxtblproductos b ,ecommerce_tblproductos c where b.idorigen=$idproducto and c.id=$idproducto and a.id=b.iddestino and a.idactivo not in (2,9) group by a.dsm";
			                      //*********  Bloque  Valores Segun Tipo Cliente ******************
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
                     
                      //*********  Fin Bloque  Valores Segun Tipo Cliente ******************	



			$vermas_t=$db->Execute($sql);
	   		if(!$vermas_t->EOF){
			$data="<select  name='idtalla' id='idtalla'  onclick='ocultar(mensaje)'>";
			$data.="<option value=''>--Seleccione--</option>";
			while (!$vermas_t->EOF) {
	   		$idtalla=$vermas_t->fields[0];
	   		$dsmtalla=$vermas_t->fields[1];
	   		$dsporiva=$vermas_t->fields[7];// porcentaje impuesto
	   		//$dsflete=$vermas_t->fields[8];//
        $dsflete=0;
	   		$dsreferencia=$vermas_t->fields[9];
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


                        $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
                        $precio=$precio-$preciodescuento;
                        $preciodescuento_f=number_format($preciodescuento,0);

                        

            if($tipocliente==2){
            $precio=$vermas_t->fields[3];
            $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
            $preciodescuento_f=number_format($preciodescuento,0);
            $iva=($precio*($dsporiva/100));
            $preciox=$idtalla."|".number_format($precio+$dsflete+$iva+$valorseguro,0)."|".($precio+$dsflete+$iva+$valorseguro)."|".$preciodescuento."|".$preciodescuento_f;
            }elseif($tipocliente==3){
            $precio=$vermas_t->fields[4];
            $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
            $preciodescuento_f=number_format($preciodescuento,0);
            $iva=($precio*($dsporiva/100));
            $preciox=$idtalla."|".number_format($precio+$dsflete+$iva+$valorseguro,0)."|".($precio+$dsflete+$iva+$valorseguro)."|".$preciodescuento."|".$preciodescuento_f;
            }elseif($tipocliente==4){
            $precio=$vermas_t->fields[5];
            $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
            $preciodescuento_f=number_format($preciodescuento,0);
            $iva=($precio*($dsporiva/100));
            $preciox=$idtalla."|".number_format($precio+$dsflete+$iva+$valorseguro,0)."|".($precio+$dsflete+$iva+$valorseguro)."|".$preciodescuento."|".$preciodescuento_f;
            }elseif($tipocliente==5){
            $precio=$vermas_t->fields[6];
            $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
            $preciodescuento_f=number_format($preciodescuento,0);
            $iva=($precio*($dsporiva/100));
            $preciox=$idtalla."|".number_format($precio+$dsflete+$iva+$valorseguro,0)."|".($precio+$dsflete+$iva+$valorseguro)."|".$preciodescuento."|".$preciodescuento_f;
            }else{
	   		$precio=$vermas_t->fields[2];
            $preciodescuento=($precio*($promodescuento/100));//  Valor Descunto
            $precio=$precio-$preciodescuento;
            $preciodescuento_f=number_format($preciodescuento,0);
	   		$iva=($precio*($dsporiva/100));
	   		$preciox=$idtalla."|".number_format($precio+$dsflete+$iva+$valorseguro,0)."|".($precio+$dsflete+$iva+$valorseguro)."|".$preciodescuento."|".$preciodescuento_f;
	   		}

            
            $data.="<option value='$preciox' >$dsmtalla</option>";
            $vermas_t->MoveNext();
            }

            $data.="</select>";
            }else{
                $data="-1";
            }$vermas_t->Close();
            
include("../../incluidos_modulos/cerrarconexion.php");


echo $data;