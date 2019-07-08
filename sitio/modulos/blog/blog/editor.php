<?
/*
| ----------------------------------------------------------------- |
Sender version 3.5
Un Producto de Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2007
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
 Editor Generico basado ebn tinymce
 */

?>
<script type="text/javascript" src="../tinymce_3.5.0.1/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		width: "100%",
		height: "450",

		ask: true,
		mode : "textareas",
		theme : "advanced",
		plugins : "lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
		//plugins : "safari,pagebreak,style,layer,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,inlinepopups",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,cut,copy,paste,image,code,forecolor,backcolor,iespell,media,fullscreen",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		// Example content CSS (should be your site CSS)
		content_css : "css/global.css",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../tinymce_3.5.0.1/tinymce/examples/lists/template_list.js",
		external_link_list_url : "../tinymce_3.5.0.1/tinymce/examples/lists/link_list.js",
		external_image_list_url : "documentos.java.php",
		media_external_list_url : "../tinymce_3.5.0.1/tinymce/examples/lists/media_list.js",
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
	<tr bgcolor="<? echo $fondos[9];?>" align=center>
			<td valign=top colspan=2>
<textarea rows=15 cols=100 name="Cuerpo" style="width: 100%" ><?
if ($idx<>""){
	echo $Cuerpo;
	} else {
	//include("plantilla.php");
}
?>
</textarea>
<br>
<a name="imagenes"></a>
<a href="#imagenes" onclick="abrirV('documentos.php?enca=1')">Click para subir imagenes al servidor</a>
	</td>
	</tr>
	<script language="JavaScript" type="text/javascript">
	function abrirV(pagina){
	var ruta=pagina;
			window.open(ruta,"",'scrollbars=yes,width=800,height=600,left=50,top=2,resizable=yes');
	}
	</script>
