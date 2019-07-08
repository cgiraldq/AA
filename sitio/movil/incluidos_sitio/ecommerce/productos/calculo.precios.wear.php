      <?// $db->debug=true;
      $id=$idproducto;
                  $tipocliente=seldato("idtipocliente","id","tblclientes",$_SESSION['i_idcliente'],1);
                  $sql = "select";
                  if($tipocliente==2) {
                  $sql.=" max(a.dsprecio2),min(a.dsprecio2)";
                   }elseif($tipocliente==3){
                  $sql.=" max(a.dsprecio3),min(a.dsprecio3)";
                    }elseif($tipocliente==4){
                  $sql.=" max(a.dsprecio4),min(a.dsprecio4)";
                   }elseif($tipocliente==5){
                  $sql.=" max(a.dsprecio5),min(a.dsprecio5)";
                   }else {
                  $sql.=" max(a.dsprecio1),min(a.dsprecio1)";
                  }
                  $sql.=",b.iva,b.dsflete";
                  $sql.=" FROM ecommerce_tbltallasxtblproductos a ,ecommerce_tblproductos b WHERE a.idorigen=$idproducto and a.idorigen=b.id and a.dsunidad>0";   
                  $result_p = $db->Execute($sql);
                  if (!$result_p->EOF) {
                  $p_mayor=$result_p->fields[0];
                  $p_menor=$result_p->fields[1];
                  $p_iva=$result_p->fields[2];
                  //$p_flete=$result_p->fields[3];
                  $p_flete=0;
                  /*
                  $p_mayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
                  $p_menor=$p_menor+($p_menor*($p_iva/100)+$p_flete);
                  */
                  }$result_p->Close();

      

                       //**********************inicio  Valor De La Promocion ***********************//


            		$sqldes="select a.id,a.dsporcentaje,idprecio  from ecommerce_tblpromociones a , ";
                        $sqldes.="ecommerce_tblpromocionesxproducto b where  1 and idactivo not in (2,9) ";
                        $sqldes.=" and ".date("YmdHi")." between idfechai and idfechaf ";
          			$sqldes.=" and b.idprecio=$xprecio ";
                        $sqldes.=" and (iddestino=$id or dsref='$dsreferencia')";
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

                       //**********************Fin  Valor De La Promocion ***********************//


                        $pordescuentom=$promodescuento;
                        $preciodescuento_me=($p_menor*($promodescuento/100));//  Valor Descunto
                        $preciodescuento_ma=($p_mayor*($promodescuento/100));//  Valor Descunto
                        $p_mayor= ($p_mayor-$preciodescuento_ma);
                        $p_menor= ($p_menor-$preciodescuento_me);
                        $preciomayor=$p_mayor+($p_mayor*($p_iva/100)+$p_flete);
                        $preciomenor=$p_menor+($p_menor*($p_iva/100)+$p_flete);   

                        ?>