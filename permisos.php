<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
    <title>Wolfcast CHMOD Scriptlet</title> 
    <meta name="description" content="Wolfcast CHMOD Scriptlet Version 1.0"> 
    <meta name="author" content="Alexandre Valiquette (www.wolfcast.com)"> 

    <style type="text/css"> 
        div#logtext 
        { 
            width: 875px; 
            height: 300px; 
            overflow: auto; 
            border: solid 1px black; 
        } 
        div#logtext p 
        { 
            white-space: nowrap; 
            margin: 0px; 
        } 
        div#logtext p.success 
        { 
            color: #008000; 
        } 
        div#logtext p.error 
        { 
            color: #ff0000; 
        } 
    </style> 
</head> 

<body> 

<p> 
    <big><b>Wolfcast CHMOD Scriptlet</b></big><br> 
    <small>Version 1.0<br> 
    <a href="http://www.wolfcast.com">www.wolfcast.com</a><br></small> 
</p> 

<!-- START - PHP generated output --> 
<?php 

//--------------------------------------------------------------------------- 

//rChmod will recursively CHMOD $dir and it's content to $dirModes for directories and to $fileModes for files. 
//$dirModes and $fileModes must start with 0 (755 become 0755 for instance). 
//rChmod returns the number of failed CHMOD operations. 
function rChmod( $dir = "./", $dirModes = 0755, $fileModes = 0644 ) 
{ 
    $retval = 0; //Number of failed CHMOD operations 
    echo "<p style=\"margin-bottom: 0px\"><b>Log:</b></p>\r\n<div id=\"logtext\">\r\n"; 

    $d = new RecursiveDirectoryIterator( $dir ); 
    foreach ( new RecursiveIteratorIterator( $d, 1 ) as $path ) 
    { 
        $chmodret = false; 

        if ( $path->isDir() ) 
            $chmodret = chmod( $path, $dirModes ); 
        else 
            if ( is_file( $path ) ) 
                $chmodret = chmod( $path, $fileModes ); 

        if ($chmodret) 
            $pclassname = "success"; 
        else 
        { 
            $pclassname = "error"; 
            ++$retval; 
        } 

        echo "<p class=\"" . $pclassname . "\">" . $path . "</p>\r\n"; 
    } 

    echo "</div>\r\n"; 
    return $retval; 
} 

//--------------------------------------------------------------------------- 

//Change the following line to fit your needs (path, directories CHMOD value, files CHMOD value). CHMOD values must start with 0. 
$nbfailed = rChmod( "./", 0755, 0644 ); 

echo "<p style=\"margin-top: 0px\"><b>"; 
if ($nbfailed > 0) 
{ 
    echo $nbfailed . " CHMOD operation(s) failed! See log above."; 
} 
else 
    echo "No error encountered."; 
echo "</b></p>\r\n"; 

?> 
<!-- END - PHP generated output --> 

<p> 
    <img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"> 
</p> 

</body> 
</html>