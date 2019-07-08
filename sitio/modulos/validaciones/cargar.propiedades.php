<?
$data='<?xml version = "1.0" encoding = "UTF-8"?>';
$data.='<UploadXML>';
$data.='<Version>1.1</Version>';
$data.='<Adverts xmlns:xsi = "http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation = "FR-Adverts.xsd">';

$sql="Select a.id,a.dscampo17,a.dscampo27,a.dscampo1,a.dscampo28,a.dscampo116,a.dscampo85,a.dscampo114,a.dscampo41,a.dscampo43,a.idagrupamiento";
$sql.=",a.dscampo13,a.dscampo11,a.dscampo178,a.dscampo179,a.dscampo69,a.idactivo,a.dscampo109,a.dscampo53,a.dscampo36,a.dscampo9,a.dscampo177";
$sql.=",a.dscampo6,a.idusuario,a.dscampo93 from framecf_tblregistro_formularios a where a.idactivo in(1,3,4) and a.clasgratis=2 and a.idformulario=104  ";
$sql.=" and a.dscampo11 in('Venta','Arriendo') and a.idagrupamiento not in('')";
  //echo $sql. "<br><br>";
$result=$db->execute($sql);

if (!$result->EOF) {
  while(!$result->EOF) {

    if($result->fields[1]=="") $result->fields[1]=0;
    if($result->fields[2]=="") $result->fields[2]=0;
    if($result->fields[3]=="") $result->fields[3]=0;
    if($result->fields[4]=="") $result->fields[4]=0;
    if($result->fields[5]=="") $result->fields[5]=0;
    if($result->fields[6]=="") $result->fields[6]=0;
    if($result->fields[7]=="") $result->fields[7]=0;
    if($result->fields[8]=="") $result->fields[8]=0;
    if($result->fields[9]=="") $result->fields[9]=0;
    if($result->fields[10]=="") $result->fields[10]=0;
    if($result->fields[11]=="") $result->fields[11]=0;
    if($result->fields[12]=="") $result->fields[12]=0;
    if($result->fields[13]=="") $valor1=0;
    if($result->fields[14]=="") $valor2=0;

    if($result->fields[16]=="") $result->fields[16]=0;
    if($result->fields[17]=="") $result->fields[17]=0;
    if($result->fields[18]=="") $result->fields[18]=0;

    if($result->fields[19]=="") $result->fields[19]=0;
    if($result->fields[20]=="") $result->fields[20]=0;
    if($result->fields[21]=="") $valor6=0;
    if($result->fields[22]=="") $valor7=0;




    if($result->fields[16]=="") $idactivo=0;
    if($result->fields[16]==1 || $result->fields[16]==3 || $result->fields[16]==4){ $idactivo=2;}elseif ($result->fields[16]==2) {$idactivo=3;}

    $data.='<Advert>';

      $data.='<ReferenceId>'.$result->fields[0].'</ReferenceId>';

	  $data.='<Emails>';
        $emailasesor=seldato("dscorreo1","id","tblempresa",1,2);
        if($emailasesor=="") $emailasesor=0;
        $data.='<Email>'.$emailasesor.'</Email>'; // email asesor city
        $emailcity=seldato("dscorreo","id","tblusuarios",$result->fields[23],2);
        if($emailcity=="") $emailcity=0;
        $data.='<Email>'.$emailcity.'</Email>';  // email cityrail
    $data.='</Emails>';

	  $data.='<Neighborhood>'.mb_convert_encoding($result->fields[2], "UTF-8", "ISO-8859-1").'</Neighborhood>';
	  $data.='<Address>'.mb_convert_encoding($result->fields[3], "UTF-8", "ISO-8859-1").' '.mb_convert_encoding($result->fields[2], "UTF-8", "ISO-8859-1").'</Address>';



    $data.='<Phones>';
        $telasesor=seldato("dstelefono","id","tblremate",3,2);
        if($telasesor=="") $telasesor=0;
        $data.='<Phone>'.$telasesor.'</Phone>';  // telefono asesor

        $telcity=seldato("dscel","id","tblusuarios",$result->fields[23],2);
        if($telcity=="") $telcity=0;
        $data.='<Phone>'.$telcity.'</Phone>';  // telefono city raiz
		    $data.='<Phone>0</Phone>';
    $data.='</Phones>';

	  $data.='<Prices>';
        $data.='<Price Value="'.$result->fields[4].'" Currency="COP" />';
    $data.='</Prices>';

	  $data.='<AdministrationPrices>';
        $data.='<Price Value="'.$result->fields[5].'" Currency="COP" />';
    $data.='</AdministrationPrices>';

	  $data.='<BuiltArea>'.$result->fields[6].'</BuiltArea>';

	  $data.='<LivingArea>'.$result->fields[7].'</LivingArea>';

	  $data.='<TotalArea>0</TotalArea>';

	  $data.='<Rooms>'.$result->fields[8].'</Rooms>';

    $data.='<Baths>'.$result->fields[9].'</Baths>';

     // $cat=seldato('idcodigo','idcampo','framecf_tbltiposformulariosxequivalenciasxagrupamiento',$result->fields[10],2);
      //if($cat=="") $cat=0;
      $sqlx=" SELECT idcodigo FROM framecf_tbltiposformulariosxequivalenciasxagrupamiento where idcampo=".$result->fields[10]." and idwebservice=1";
       //echo $sqlx;
       $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $cat=$resultx->fields[0];
        }
        $resultx->Close();

        if($cat=="") $cat=0;
	   $data.='<CategoryId>'.$cat.'</CategoryId>';

	   $data.='<Location1Id>55</Location1Id>'; // departamento

     //$ciudad=seldato('id','dsm','framecf_tbltiposformulariosxcampos',$result->fields[11],2);

      $sqlx=" SELECT id FROM framecf_tbltiposformulariosxcampos where dsm='".$result->fields[11]."' and idtipoformulario=104";
       //echo $sqlx;
       $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $ciudad=$resultx->fields[0];
        }
        $resultx->Close();
     //if($barrio=="") $barrio=0;

      $sqlx=" SELECT idcodigo FROM framecf_tbltiposformulariosxequivalenciasxciudades where idsubcampo='".$ciudad."' and idwebservice=1";
       //echo $sqlx;
       $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $ciudad=$resultx->fields[0];
        }
        $resultx->Close();
        if($ciudad=="") $ciudad=0;

	   $data.='<Location2Id>'.$ciudad.'</Location2Id>'; // ciudad


     $sqlx=" SELECT idcodigo FROM framecf_tbltiposformulariosxequivalenciasxciudadesxzonas where idsubcampo='".$ciudad."' and idzonas='".$result->fields[24]."' and idwebservice=1";
       //echo $sqlx;
       $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $zonas=$resultx->fields[0];
        }
        $resultx->Close();
        if($zonas=="") $zonas=0;


	   $data.='<Location3Id>'.$zonas.'</Location3Id>'; // zona


     $idbarrio=seldato('id','dsm','framecf_tbltiposformulariosxcamposxsubcampos',$result->fields[2],2);
     $sqlx=" SELECT idcodigo FROM  framecf_tbltiposformulariosxequivalenciasxciudadesxbarrios where idsubcampo='".$ciudad."' and idbarrio='".$idbarrio."' and idwebservice=1";
       //echo $sqlx;
       $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $barrio=$resultx->fields[0];
        }
        $resultx->Close();
        if($barrio=="") $barrio=0;

	   $data.='<Location4Id>'.$barrio.'</Location4Id>'; // barrio

	   $data.='<Location5Id>0</Location5Id>';


     if($result->fields[12]=="")$disponibilidad=0;
    if($result->fields[12]=="Venta"){$disponibilidad=1;}elseif($result->fields[12]=="Arriendo"){$disponibilidad=3;}

	   $data.='<TransactionId>'.$disponibilidad.'</TransactionId>';


      $idcampox=seldato('id','dsm','framecf_tbltiposformulariosxcampos',$result->fields[13],2);
     $sqlx=" select idcodigo from framecf_tbltiposformulariosxequivalenciasxsubcampos where idtipoformulario='104' and idsubcampo='$idcampox' ";
    // echo $sqlx;
     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $valor1=$resultx->fields[0];
           if($valor1=="") $valor1=0;
        }
        $resultx->Close();

	   $data.='<ConditionId>'.$valor1.'</ConditionId>';


       $idcampoy=seldato('id','dsm','framecf_tbltiposformulariosxcampos',$result->fields[14],2);
      $sqlx=" select idcodigo from framecf_tbltiposformulariosxequivalenciasxsubcampos where idtipoformulario='104' and idsubcampo='".$idcampoy."'; ";
      //echo $sqlx;
     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $valor2=$resultx->fields[0];
           if($valor2=="") $valor2=0;
        }
        $resultx->Close();

	   $data.='<AgeId>'.$valor2.'</AgeId>';

      $sql=" SELECT id FROM framecf_tbltiposformulariosxcampo WHERE dscampo='dscampo69' and idtipoformulario='104' ";
   //echo $sql;
   $resultx=$db->execute($sql);
        if (!$resultx->EOF) {
      $idpiso=$resultx->fields[0];
        }
        $resultx->Close();

      $pisox=$result->fields[15];
     $sql=" SELECT id FROM  framecf_tbltiposformulariosxcampos WHERE dsm='$pisox' and idcampo='$idpiso' and idtipoformulario='104' ";
  // echo $sql;
   $resultx=$db->execute($sql);
        if (!$resultx->EOF) {
      $idpisox=$resultx->fields[0];
        }
        $resultx->Close();

      $sqlx=" select idcodigo from framecf_tbltiposformulariosxequivalenciasxsubcampos where idtipoformulario='104' and idsubcampo='".$idpisox."'; ";
     //echo $sqlx;

     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $valor3=$resultx->fields[0];
        }
        $resultx->Close();

        if($valor3=="")  $valor3=0;
 //exit();
	   $data.='<FloorId>'.$valor3.'</FloorId>';

	   $data.='<StatusId>'.$idactivo.'</StatusId>';

	   $data.='<Features>';

    $sqlx="select a.id,a.dsm,a.dscampo,a.idcodigo";
    $sqlx.=" from framecf_tbltiposformulariosxcampo a, framecf_tbltiposformulariosxcamposxagrupamiento b,tblagrupamientoxtblformularios c  where a.idactivo=1 and a.idtipoformulario=104";
    $sqlx.=" and a.idtipoformulario=b.idformulario and b.id=c.idorigen and a.id=c.iddestino and c.idorigen=".$result->fields[10]." and a.idcodigo not in('') order by a.idpos asc; ";

     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
          while (!$resultx->EOF) {
           $valor4=$resultx->fields[3];
            $dscampo=$resultx->fields[2];
             $idxy=$resultx->fields[0];

             $sqlxx=" select idcodigo from  framecf_tbltiposformulariosxequivalencias where idcampo='$idxy' and idtipoformulario=104 ";
              //echo $sqlxx;
                 $resultxx=$db->execute($sqlxx);
                    if (!$resultxx->EOF) {
                       $data.='<FeatureId>'.$resultxx->fields[0].'</FeatureId>';
                    }
                  $resultxx->Close();

          $resultx->MoveNext();
         }
        }
        $resultx->Close();
     $data.='</Features>';



	   $data.='<Multimedias>';
    $sqlx=" select dsimg from framecf_tbltiposformulariosxgalerias where idtipoformulario=104 and idregistro=".$result->fields[0]." order by idactivo desc ";
     //echo $sqlx;
     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
          $cont=1;
          while (!$resultx->EOF) {
              $valor5=$resultx->fields[0];

              if($cont==1){$valores=1;}else{$valores=0;}
$data.='<Multimedia url="http://www.comprandofacil.com/clientes/cityraiz3/contenidos/images/galeria/'.$valor5.'" isPrincipal="'.$valores.'" TypeId="'.$valores.'"/>';

        $cont++;
        $resultx->MoveNext();
         }
        }
      $resultx->Close();
        // $data.='<Multimedia url="http://ejemplo.com/fotos/L_feab5037807b4fad9f9d731f6f48e216_iList.jpg" isPrincipal = "0" TypeId = "2"/>';
       $data.='</Multimedias>';


	   $data.='<Description>'.mb_convert_encoding($result->fields[20],"UTF-8", "ISO-8859-1").'</Description>';






     $idcampox=seldato('id','dsm','framecf_tbltiposformulariosxcampos',$result->fields[21],2);
     $sqlx=" select idcodigo from framecf_tbltiposformulariosxequivalenciasxsubcampos where idtipoformulario='104' and idsubcampo='".$idcampox."'; ";

     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $valor6=$resultx->fields[0];
        }
        $resultx->Close();
	  $data.='<WeatherId>'.$valor6.'</WeatherId>';

    $sql=" SELECT id FROM framecf_tbltiposformulariosxcampo WHERE dscampo='dscampo6' and idtipoformulario=104 ";
   //echo $sql;
   $resultx=$db->execute($sql);
        if (!$resultx->EOF) {
      $id1=$resultx->fields[0];
        }
        $resultx->Close();

   //echo $result->fields[22];
    $sql=" SELECT id FROM framecf_tbltiposformulariosxcampos WHERE dsm='".$result->fields[22]."' and idcampo='$id1' and idtipoformulario=104 ";

   $resultx=$db->execute($sql);
        if (!$resultx->EOF) {
        $id2=$resultx->fields[0];
        }
        $resultx->Close();


     $sqlx=" select idcodigo from framecf_tbltiposformulariosxequivalenciasxsubcampos where idtipoformulario='104' and idsubcampo='".$id2."'; ";
//echo $sqlx;
     $resultx=$db->execute($sqlx);
        if (!$resultx->EOF) {
           $valor7=$resultx->fields[0];
        }
        $resultx->Close();

        if($valor7=="") $valor7=0;

      $data.='<StratumId>'.$valor7.'</StratumId>';

	  $data.='<ViewMapId>1</ViewMapId>';

      $data.='<Latitude>0</Latitude>';

      $data.='<Longitude>0</Longitude>';

    $data.='</Advert>';



$result->MoveNext();
  }
}
$result->Close();

  $data.='</Adverts>';
 $data.='</UploadXML>';

//echo $data;
//exit();


$fp=fopen('../../../contenidos/images/xml/FR_'.date('Y_m_d').'_Full.xml', 'w+');
fwrite($fp, $data);
fclose($fp);

?>
