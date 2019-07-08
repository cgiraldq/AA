<?
/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
 Panel principal de carga de documentos o imagenes por cliente
*/
include("../../incluidos_modulos/modulos.globales.php");
	$enviar=$_REQUEST['enviar'];
	$rutaImagen="../../../contenidos/images/blog/";
	 $imgx=$_REQUEST['imgx'];

if ($enviar=="Subir"){
	$site_name = $_SERVER['HTTP_HOST'];
	$rutaImagen="../../../contenidos/images/blog/";
	//$url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	 $url_dir = "http://".$_SERVER['HTTP_HOST'].$rutaAbs."/";
	 $url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
 	 $upload_dir = $rutaImagen;
	  $upload_url = $url_dir.$rutaImagen;
	 $message ="";

	//create upload_files directory if not exist
	//If it does not work, create on your own and change permission.
	if (!is_dir($upload_dir)) {
		die ("Primero debe esta la carpeta configurada $upload_dir");
	}
// upload
	if ($_FILES['userfile']['name']<>"") {
		$temp_name = $_FILES['userfile']['tmp_name'];
		$file_name = $_FILES['userfile']['name'];
		$file_type = $_FILES['userfile']['type'];
		$file_size = $_FILES['userfile']['size'];
		$result    = $_FILES['userfile']['error'];
		$file_url  = $upload_url.$file_name;
		// $file_path = $upload_dir.date("ymdhis")."-".$file_name;
		$file_path = $upload_dir.$file_name;
		//File Name Check
		if ( $file_name =="") {
			$message = "Nombre no valido de archivo";
		}
		//File Size Check
		else if ( $file_size > 60000) {
			$message = "Este archivo pesa mas de 60KB.";
		}
		//File Type Check
		else if ( $file_type == "text/plain" ) {
			$message = "No puede subir archivos tipo script" ;
		}

		if (move_uploaded_file($temp_name,$file_path)) {
			$message="El archivo <strong>$file_name</strong> fué cargado con éxito";
		} else {
			$message = "El archivo <strong>$file_name</strong> no fué cargado con éxito";
		}
	// fin upload
	}
	else {
		$message = "tipo de archivo invalido.";
	}
}
if ($enviar=="Eliminar"){


	// verificacion
		if (unlink($rutaImagen.$imgx)) {


		$mensaje="<font color=".$fondo6.">Imagen Eliminada (".$rutaImagen.$rutax."".$imgx.").</font>";
	} else {
		$mensaje="<font color=".$fondo6.">La Imagen no puede ser eliminada (".$rutaImagen.$rutax."".$imgx.").</font>";

	}



}
?>
<html>
<head>
		<?include("../../incluidos_modulos/head.php");?>

</head>
<body color=#ffffff  topmargin=0 leftmargin=1>
	<table width=100% align=center  cellpadding=4 cellspacing=0>
		<tr align=left >
			<td valign=top colspan=2 bgcolor="<? echo $fondos[9];?>"><font class=titulo1><? echo "Admninistrador de documentos, "." ".$_SESSION['i_dsnombre'];?>
			</font></td>
		</tr>
		<tr align=center >
			<td valign=top colspan=2 background="temas/imagenes/barraseparador2.jpg" height="4"></td>
		</tr>
	</table>
<br>

	<table align="center"  cellspacing="0" cellpadding="0" border="0" width=100% class="text1">
<tr bgcolor="<? echo $fondos[9];?>" class=titulo1 width=100%>
<td>GALERIA DE IMAGENES EN GENERAL DEL SISTEMA</td>
</tr>

<tr bgcolor="<? echo $fondos[8];?>" class=text1 width=100%>
<td><strong><? echo $mensaje;?></strong>

</td>
</tr>

</table>
<?
$rutaGalerias="../../../contenidos/";
$ruta="/images/blog/";
if ($ruta<>""){
	 $rutaImagen="".$rutaGalerias."/".$ruta."/";
?>
<br>
	<table align="center"  bgcolor="<? echo $fondos[5];?>" cellspacing="0" cellpadding="0" border="0" width=50% class="text1">
	<tr  align=center bgcolor="<? echo $fondo1;?>">
		<td><strong>SUBIR IMAGEN AL SERVIDOR</strong></td>
	</tr>
	<form name="upload" id="upload" ENCTYPE="multipart/form-data" method="post" action="<? echo $PHP_SELF;?>">
	<tr  align=center bgcolor="<? echo $fondos[5];?>">
		<td>Seleccione el archivo y presione "Subir"
		<br>
		  <input type="file" id="userfile" name="userfile" class=textos>
		  <input type="hidden" name="upload" value="Upload">
		  <input type="hidden" name="id" value="<? echo $id;?>">
		  <input type="hidden" name="ruta" value="<? echo $ruta;?>">
		  <input type="hidden" name="rutaImagen" value="<? echo $rutaImagen;?>">
		  <input type="submit" name="enviar" value="Subir" class=textos>
		  <input type="hidden" name="enca" value="<? echo $enca;?>">

		  <br>
		  <br>
		  <? echo $message;?>
		  <br>
		</td>
	</tr>
	</form>
	</table>
	<br>
<?
} // fin $ruta
?>

<?
 $ruta;
if ($ruta<>""){


	// carga de paginacion
	$handle2=@opendir($rutaImagen);



	$x=0;
	while ($file2 = readdir($handle2)) {

		 if ($file2 <> "." && $file2 <> ".." && $file2 <>"peq" && $file2 <>"iconos" && $file1 <>"noticias" && $file1 <>"banner" && $file2 <>"menuderecho" && $file2 <>"Thumbs.db" && $file2 <>"clientes") {
		$x++;

		}
	}
	$pp = 35; // paginacion
	if(isset($_GET['st'])) {
	   $st = $_GET['st']; // iniio
	   $fin=$st+$pp; // fin
	} else {
	   $st = 0; // inicio
	   $fin=$pp; // fin
}
	echo "<font class=textos>Listando ".$st."-".$fin." Imágenes.  <strong>Ver ";
	echo paginacion($x, $pp, $st, 'documentos.php?enca='.$enca.'&ruta='.$ruta.'&st=');
	echo "</font></strong><br><br>";
?>
<table align="center"  cellspacing="2" cellpadding="0" border="0" width=100% style="Table-layout:fixed;" class="text1">
<tr align=center bgcolor="<? echo $fondo1;?>">
	<td>Imagen</td>
	<td>Nombre</td>
</tr>
</table>
<br>
<?
// cargada del directorio
$handle1=@opendir($rutaImagen);
	$j=0;
  while ($file1 = readdir($handle1)) {
	   if ($file1 <> "." && $file1 <> ".." && $file1 <>"peq" && $file1 <>"iconos" && $file1 <>"noticias" && $file1 <>"banner" && $file1 <>"menuderecho" && $file1 <>"Thumbs.db" && $file1 <>"clientes") {
	 	if ($j>=$st && $j<=$fin) { // paginacion
			?>
			<table align="center"  cellspacing="2" cellpadding="0" border="0" width=100% style="Table-layout:fixed;" class="campos_ingreso">
			<tr onMouseOut="mOut(this,'<? echo  $fondo5;?>');" onMouseOver="mOvr(this,'<? echo  $fondo2;?>');">
			<form action="<? echo $PHP_SELF;?>" method=post name="forma_<? echo $j;?>">
			<td  align=center >
			<a href="<? echo $rutaImagen;?><? echo $file1;?>" target="_blank">
			<img src="<? echo $rutaImagen;?><? echo $file1;?>" width=50 height=50 alt="foto <? echo $file1;?>" border=></a>
			<BR><input type=submit name=enviar value="Eliminar" class=adminforma1>
			</td>
			<td  align=center bgcolor="<? echo $fondo2;?>"><? echo $file1;?>
			<input type=hidden name=rutax value="<? echo $ruta;?>">
			<input type=hidden name=imgx value="<? echo $file1;?>">
			<input type=hidden name=enca value="<? echo $enca;?>">

			</td>
			</form>
			</tr>
			</table>
			 <?
			$j=$j+1;
		 }  else { // fin si
		 	$j++;
		 }

	} // fin paginacion

} // fin ciclo
closedir($handle1);
} // fin $ruta
?>



<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>

<?php
// la función
function paginacion($total,$pp,$st,$url) {
  if($total>$pp) {
    $resto=$total%$pp;
    if($resto==0) {
      $pages=$total/$pp;
    } else {
      $pages=(($total-$resto)/$pp)+1;
    }

    if($pages>10) {
      $current_page=($st/$pp)+1;
      if($st==0) {
        $first_page=0;
        $last_page=10;
      }elseif($current_page>=5 && $current_page<=($pages-5)){
        $first_page=$current_page-5;
        $last_page=$current_page+5;
      }elseif($current_page<5) {
        $first_page=0;
        $last_page=$current_page+5+(5-$current_page);
      } else {
        $first_page=$current_page-5-(($current_page+5)-$pages);
        $last_page=$pages;
      }
    } else {
      $first_page=0;
      $last_page=$pages;
    }

    for($i=$first_page;$i< $last_page;$i++) {
      $pge=$i+1;
      $nextst=$i*$pp;
      if($st==$nextst) {
        $page_nav .= '<b>['.$pge.']';
      } else {
        $page_nav .= '&nbsp;<a href="'.$url.$nextst.'" title="Siguientes Imagenes" class="adminb">'.$pge.'</a>&nbsp;';
      }
    }

    if($st==0) { $current_page = 1;  } else { $current_page = ($st/$pp)+1;  }

    if($current_page< $pages) {
      $page_last = '<b>[<a href="'.$url.($pages-1)*$pp.'" title="Últimos" class="adminb">>>></a>]&nbsp;';
      $page_next = '[<a href="'.$url.$current_page*$pp.'" title="Adelante" class="adminb">></a>]&nbsp;';
    }

    if($st>0) {
      $page_first = '<b>[<a href="'.$url.'0" title="Inicio" class="adminb">< <<</a>]</a></b>&nbsp;';
      $page_previous = '[<a href="'.$url.''.($current_page-2)*$pp.'" title="Anteriores" class="adminb">< </a>]&nbsp;';
    }
  }
   return "$page_first $page_previous $page_nav $page_next $page_last";
}
// mostrar resultado de la funcion
?>
