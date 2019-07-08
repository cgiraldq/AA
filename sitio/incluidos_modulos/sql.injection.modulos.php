<?
/*
| ----------------------------------------------------------------- |
SCRIPT GENERICO QUE DETERMINA POSIBLE ATAQUE DE SQL INYECTION
*/
function sql_quote($value){
	global $autorizado;
$CadenasProhibidas = array("HACKED ","HACKED","HACK","HACK ","HACKING ","HACKING","EXPLOIT ","EXPLOITED","Content-Type:","MIME-Version:",
 "Content-Transfer-Encoding:","Return-path:","From:","Envelope-to:","bcc:","cc:","DELETE ","DROP ","INSERT ","UPDATE ","CREATE ","TRUNCATE ",
 "DISTINCT ","GROUP BY"," WHERE ","RENAME ","COUNT ","HAVING ","SELECT ","SomeCustomInjectedHeader:injected_by_wvs","passwd","apt-get","script ",
 "javascript","<?php","vbscript ","mailto:","phpinfo","waitfor","delay","base64",
 'javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe',
 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base','onabort', 'onactivate', 'onafterprint', 'onafterupdate',
 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint',
 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect',
 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend',
 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish',
 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture',
 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove',
 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart',
 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart',
 'onstop', 'onsubmit', 'onunload',
 'object', 'style', 'form ', 'php ', ']', 'img ','database ','DATABASE ');

$pattern = array("/0x27/","/%0a/","/%0A/","/%0d/","/%0D/","/0x3a/","/ select /i","/insert /i",
                     "/from /i","/union /i","/concat /i","/delete /i","/truncate /i","/alter /i",
                     "/information_schema/i","/unhex/i","/load_file/i","/outfile/i","/0xbf27/");

	if (!is_array($value))
	{
		foreach($CadenasProhibidas as $valor){
			if(strpos(strtolower($value), strtolower($valor)) !== false){
				echo "Advertencia: Este contenido puede presentar problemas ".$value." --- ".$valor."<br>";
			}
		}
		if(get_magic_quotes_gpc())
		$value = stripslashes($value);
		//check if this function exists
	if(function_exists("mysql_real_escape_string"))
				$value = mysql_real_escape_string( $value );
			else//for PHP version <4.3.0 use addslashes
				$value = addslashes( $value );
	}

    $valor = preg_replace($pattern, "", $value);
    foreach($pattern as $patt) {
        if(preg_match($patt, $value)) {
				echo "Advertencia: Este contenido puede presentar problemas ".$patt." --- ".$value."<br>";
		}
    }
    return $value;


}

if (count($_GET)) {
		while (list($key, $val) = each($_GET)) {
				@sql_quote($val);
		}
}
if (count($_POST)) {
		while (list($key, $val) = each($_POST)) {
				@sql_quote($val);
		}

}
if (count($_FILES)) {
		while (list($key, $val) = each($_FILES)) {
				@sql_quote($val);
		}

}
if (count($_SESSION)) {
		while (list($key, $val) = each($_SESSION)) {
				@sql_quote($val);
		}

}

?>