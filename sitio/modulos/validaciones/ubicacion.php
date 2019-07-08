<?include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/modulos.funciones.php");?>

				<?
				//$db->debug=true;
				$idpais=$_REQUEST['idpais'];
				$idciudad=$_REQUEST['idciudad'];
				$iddepartamento=$_REQUEST['iddepartamento'];
				/*===============bloque pais======================*/
				$sqlp="select id,dsm FROM tblpaises where idactivo=1 ";
				if($idpais<>"")$sqlp.=" and  id=$idpais";
				$resultp=$db->Execute($sqlp);
				if(!$resultp->EOF){
				//$data="<article class='contenedor_tiendas'>";
				while(!$resultp->EOF) {
				$idp=$resultp->fields[0];
				$dsmp=utf8_encode($resultp->fields[1]);
				//$data.="<h2>$dsmp</h2><br>";//<!--pais-->
				/*===============fin bloque pais======================*/
				/*===============bloque departamento ======================*/
				$sqld= "select a.id,a.dsm FROM tbldepartamentos a , tblpaisxdepartamento b where a.idactivo not in (2,9) ";
				$sqld.= " and a.id=b.iddestino and b.idorigen=$idp";
				if($iddepartamento<>"")$sqld.=" and  a.id=$iddepartamento";
				$resultd=$db->Execute($sqld);
				if (!$resultd->EOF) {
				while(!$resultd->EOF){
				$idd=$resultd->fields[0];
				$dsmd=utf8_encode($resultd->fields[1]);
				//$data.="<h2>$dsmd</h2><br>";//<!--departamento-->
				/*===============bloque departamento======================*/
				$sqlc = "select a.id,a.dsm FROM tblciudades a ,tbldepartamentosxciudad b where a.idactivo not in (2,9) ";
				$sqlc.= " and a.id=b.iddestino and b.idorigen=$idd";
				if($idciudad<>"")$sqlc.=" and  a.id=$idciudad";
				$resultc=$db->Execute($sqlc);
				if (!$resultc->EOF) {
				while(!$resultc->EOF){
				$idc=$resultc->fields[0];
				$dsmc=utf8_encode($resultc->fields[1]);
				$total=seldato('count(*)','idciudad','cms_tbltiendas',$idc,1);
				if($total>0){
				$data.="<h2>$dsmc</h2>";//<!--ciudades-->
				$sqlx = "select a.id,a.dsm,a.dsd ";
				$sqlx.=" FROM cms_tbltiendas a ";
				$sqlx.="WHERE a.id>0 and a.idciudad=$idc and a.idactivo not in (2,9) ";
				$resultx=$db->Execute($sqlx);
				if (!$resultx->EOF) {
				while(!$resultx->EOF){
				$idt=$resultx->fields[0];
				$dsmt=utf8_encode($resultx->fields[1]);
				$dsdt=utf8_encode($resultx->fields[2]);

				$data.="<ul>";
				$data.="<li>";
				$data.="<h3>$dsmt</h3>";
				$data.="$dsdt";
				$data.="<a href='mapa.php?idtienda=$idt' rel='ver_mapa' onclick='cargar();' class='ver_tienda ver_mapa'>ver tienda</a>";				
				$data.="</li>";
				$data.="</ul>";




				#=======fin ciudades====
				$resultx->MoveNext();
				} // fin while
				}
				$resultx->Close();
				}// validacion
				#=======fin depatamento====
				$resultc->MoveNext();
				}
				}$resultc->Close();
				#=======fin depatamento====
				$resultd->MoveNext();
				}
				}$resultd->Close();
				#=======fin pais=====
				$resultp->MoveNext();
				}
				//$data.="</article>";
				}else{
				$data=-1;
				}$resultp->Close();

				include("../../incluidos_modulos/cerrarconexion.php");

				echo $data;





				?>

