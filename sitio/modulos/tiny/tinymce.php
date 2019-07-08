<!-- TinyMCE -->
<script type="text/javascript" src="<?echo $rutxx?>../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function validar_tiny(forma) {




var formabase=eval("document."+forma);

if (formabase.elements['tiny[]'][0].value=="Activar editor de texto" || formabase.elements['tiny[]'][0].value=="Activar editor de texto"){

	tinyMCE.init({
			// General options
			width: "100%",
			ask: true,
			height: "300px",
			language : 'es',
			mode : "textareas",
			//elements : "dsdtit,dsd2,dspromocion",
			theme : "advanced",
			plugins : "safari,pagebreak,style,layer,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,inlinepopups,table,tabfocus,advlist,contextmenu",

			// Theme options
			theme_advanced_buttons1 : "equation,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,outdent,indent,code,hide,replace,forecolor",
			theme_advanced_buttons2 : "paste,pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,code,|forecolor,backcolor,link,unlink,anchor,table,fill color,tabfocus,advlist,fontcolor,tablecontrols,mathml",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example word content CSS (should be your site CSS) this one removes paragraph margins
			//content_css : "<?echo $rutxx?>../tinymce/jscripts/css/word.css",

			// Drop lists for link/image/media/template dialogs
			/*
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
			*/
			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
	});


	formabase.elements['tiny[]'][0].value="Inactivar editor de texto";
	formabase.elements['tiny[]'][1].value="Inactivar editor de texto";


	} else {
		formabase.elements['tiny[]'][0].value="Activar editor de texto";
		formabase.elements['tiny[]'][1].value="Activar editor de texto";
		// apagar//

	for (edId in tinymce.editors) {
	    tinymce.editors[edId].remove();
	}

	}

}
</script>
<!-- /TinyMCE -->

