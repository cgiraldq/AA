									<?
									$db->debug=true;
									$contarm=count($partirm);
									$contarc=count($partirc);
									$contars=count($partirs);
									if ($contarc> 0){
									$sql="delete from tbltblproductoxcategoria where idorigen=$idx";
									$db->Execute($sql);
									$h=0;
										for ($i=0;$i<$contarc;$i++){
											if(trim($partirc[$i])<>""){
											$partircc[$i]=$partirc[$i];	
											$partircc[$i]=reemplazar($partircc[$i]);
											//echo $partirc[$i]."=========Categoria<br>";
											$sqlx="select id ";
				 							$sqlx.=" from ecommerce_tblcategoria WHERE dsm='".trim($partirc[$i])."' and idactivo=1 ";
					 						$resultc = $db->Execute($sqlx);
					 						if (!$resultc->EOF) {
											$idcategoria=$resultc->fields[0];		 	// no insertar
					 						} else {

					 											 	// insertar
											$sqlx="insert into ecommerce_tblcategoria (dsm,idpos,idactivo,idnat,idtipo,dsalias,dsruta)";
											$sqlx.=" values ('".trim($partirc[$i])."',1,1,1,1,'".trim($partirc[$i])."','".limpieza(strtolower($partirc[$i]))."') ";
											if ($db->Execute($sqlx))  {
											$sqlx="select id ";
									 		$sqlx.=" from ecommerce_tblcategoria WHERE dsm='".trim($partirc[$i])."' ";
										 	$resultcc = $db->Execute($sqlx);
											 if (!$resultcc->EOF) {
											$idcategoria=$resultcc->fields[0];		 	// no insertar
											 }
											$resultcc->close();
															}
														}
											 $resultc->close();
											}		

											$sql="insert into tbltblproductoxcategoria (idorigen,iddestino) values('$idx','".trim($idcategoria)."')";
											if ($db->Execute($sql)) $h++;

										

											}
										}else{

											if(trim($partirc)<>""){
											//echo $partirc."=========Categoria<br>";
											$partircc=$partirc;	
											$partircc=reemplazar($partircc);
											$sqlx="select id ";
				 							$sqlx.=" from ecommerce_tblcategoria WHERE dsm='".trim($partirc)."' and idactivo=1";
					 						$resultc = $db->Execute($sqlx);
					 						if (!$resultc->EOF) {
											$idcategoria=$resultc->fields[0];		 	// no insertar
					 						} else {					 	// insertar
											$sqlx="insert into ecommerce_tblcategoria (dsm,idpos,idactivo,idnat,idtipo,dsalias,dsruta)";
											$sqlx.=" values ('".trim($partirc)."',0,1,1,1,'".trim($partirc)."','".limpieza(strtolower($partirc))."') ";
											if ($db->Execute($sqlx))  {
											$sqlx="select id ";
									 		$sqlx.=" from ecommerce_tblcategoria WHERE dsm='".trim($partirc)."' ";
										 	$resultcc = $db->Execute($sqlx);
											 if (!$resultcc->EOF) {
											$idcategoria=$resultcc->fields[0];		 	// no insertar
											 }
											$resultcc->close();
															}
														}
											 $resultc->close();
											}		

											$sql="insert into tbltblproductoxcategoria (idorigen,iddestino) values('$idx','".trim($idcategoria)."')";
											//echo $sql."<br>";
											if ($db->Execute($sql)) $h++;
										}				
									
	// =================================================================================================================//									
									if ($contars> 0){
									$sql="delete from ecommerce_tblsubcategoriaxtblproducto where idorigen=$idx";
									$db->Execute($sql);
									$h=0;
										for ($i=0;$i<$contars;$i++){
											if(trim($partirs[$i])<>""){
											$partirss[$i]=$partirs[$i];	
											$partirss[$i]=reemplazar($partirss[$i]);
										//	echo $partirs[$i]."=========Subcate<br>";
										$sqlx="select id ";
									 	$sqlx.=" from ecommerce_tblsubcategoriasxcategoria WHERE dsm='".trim($partirs[$i])."' and idactivo=1 ";
										$resultc = $db->Execute($sqlx);
										if (!$resultc->EOF) {
										$idsubcategoria=$resultc->fields[0];		 	// no insertar
										} else {
										$sqlx="insert into ecommerce_tblsubcategoriasxcategoria (dsm,idpos,idtipo,idactivo,dsalias,dsruta)";
										$sqlx.=" values ('".trim($partirs[$i])."',0,1,1,'".trim($partirs[$i])."','".limpieza(strtolower($partirs[$i]))."') ";
										//echo $sqlx;
										if ($db->Execute($sqlx))  {
										$sqlx="select id ";
									 	$sqlx.=" from ecommerce_tblsubcategoriasxcategoria WHERE dsm='".trim($partirs[$i])."' and idactivo=1";
	                    				$resultcc = $db->Execute($sqlx);
										if (!$resultcc->EOF) {
										$idsubcategoria=$resultcc->fields[0];		 	// no insertar
										 }
										$resultcc->close();
										}
										}
		 								$resultc->close();

										$sql="insert into ecommerce_tblsubcategoriaxtblproducto (idorigen,iddestino) values('$idx','".trim($idsubcategoria)."')";
										//echo $sql."<br>";
										if ($db->Execute($sql)) $h++;
										}
										}				
									}else{

										if(trim($partirs)<>""){
										//echo $partirs."=========Subcate<br>";
										$partirss=$partirs;	
										$partirss=reemplazar($partirss);
										
										$sqlx="select id ";
									 	$sqlx.=" from ecommerce_tblsubcategoriasxcategoria WHERE dsm='".trim($partirs)."' and idactivo=1 ";
										$resultc = $db->Execute($sqlx);
										if (!$resultc->EOF) {
										$idsubcategoria=$resultc->fields[0];		 	// no insertar
										} else {
										$sqlx="insert into ecommerce_tblsubcategoriasxcategoria (dsm,idpos,idtipo,idactivo,dsalias,dsruta)";
										$sqlx.=" values ('".trim($partirs)."',0,1,1,'".trim($partirs)."','".limpieza(strtolower($partirs))."') ";
										//echo $sqlx;
										if ($db->Execute($sqlx))  {
										$sqlx="select id ";
									 	$sqlx.=" from ecommerce_tblsubcategoriasxcategoria WHERE dsm='".trim($partirs)."' and idactivo=1 ";
	                    				$resultcc = $db->Execute($sqlx);
										if (!$resultcc->EOF) {
										$idsubcategoria=$resultcc->fields[0];		 	// no insertar
										 }
										$resultcc->close();
										}
										}
		 								$resultc->close();

										$sql="insert into ecommerce_tblsubcategoriaxtblproducto (idorigen,iddestino) values('$idx','".trim($idsubcategoria)."')";
										//echo $sql."<br>";
										if ($db->Execute($sql)) $h++;
										}	


									}




								//===================================================================================================================================//
									if ($contarm> 0){

									$sql="delete from ecommerce_tblproductoximg where idorigen=$idx";
									$db->Execute($sql);
									$h=0;
									for ($i=0;$i<$contarm;$i++){
										if($partirm[$i]<>""){
										$sql="insert into ecommerce_tblproductoximg (idorigen,iddestino,dsimg,idactivo) values($idx,$idx,'".trim($partirm[$i])."',1)";
										$db->Execute($sql);
										}
									}//  fin for	

									}else{

									$sql="delete from ecommerce_tblproductoximg where idorigen=$idx";
									$db->Execute($sql);	
									$sql="insert into ecommerce_tblproductoximg (idorigen,iddestino,dsimg,idactivo) values($idx,$idx,'".trim($partirm)."',1)";
									$db->Execute($sql);


									}// fin contarm 
								//==============================================fin relaciones con imagenes=====================================================================================//
									$db->debug=false;
									

									?>