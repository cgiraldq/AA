<?php
 return array (
  'configuration' => 
  array (
    'params' => 
    array (
    ),
    'functions' => 
    array (
      0 => 'use',
    ),
    'script_path' => 'modules/lhfile/configuration.php',
  ),
  'uploadfile' => 
  array (
    'params' => 
    array (
      0 => 'chat_id',
      1 => 'hash',
    ),
    'uparams' => 
    array (
    ),
    'script_path' => 'modules/lhfile/uploadfile.php',
  ),
  'uploadfileonline' => 
  array (
    'params' => 
    array (
      0 => 'vid',
    ),
    'uparams' => 
    array (
    ),
    'script_path' => 'modules/lhfile/uploadfileonline.php',
  ),
  'chatfileslist' => 
  array (
    'params' => 
    array (
      0 => 'chat_id',
    ),
    'uparams' => 
    array (
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/chatfileslist.php',
  ),
  'onlinefileslist' => 
  array (
    'params' => 
    array (
      0 => 'online_user_id',
    ),
    'uparams' => 
    array (
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/onlinefileslist.php',
  ),
  'useronlinefileslist' => 
  array (
    'params' => 
    array (
      0 => 'vid',
    ),
    'uparams' => 
    array (
    ),
    'functions' => 
    array (
    ),
    'script_path' => 'modules/lhfile/useronlinefileslist.php',
  ),
  'downloadfile' => 
  array (
    'params' => 
    array (
      0 => 'file_id',
      1 => 'hash',
    ),
    'uparams' => 
    array (
      0 => 'inline',
    ),
    'script_path' => 'modules/lhfile/downloadfile.php',
  ),
  'uploadfileadmin' => 
  array (
    'params' => 
    array (
      0 => 'chat_id',
    ),
    'uparams' => 
    array (
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/uploadfileadmin.php',
  ),
  'uploadfileadminonlineuser' => 
  array (
    'params' => 
    array (
      0 => 'online_user_id',
    ),
    'uparams' => 
    array (
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/uploadfileadminonlineuser.php',
  ),
  'new' => 
  array (
    'params' => 
    array (
    ),
    'uparams' => 
    array (
      0 => 'mode',
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/new.php',
  ),
  'attatchfile' => 
  array (
    'params' => 
    array (
      0 => 'chat_id',
    ),
    'uparams' => 
    array (
      0 => 'user_id',
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/attatchfile.php',
  ),
  'attatchfilemail' => 
  array (
    'params' => 
    array (
    ),
    'uparams' => 
    array (
      0 => 'mode',
      1 => 'user_id',
    ),
    'functions' => 
    array (
      0 => 'use_operator',
    ),
    'script_path' => 'modules/lhfile/attatchfilemail.php',
  ),
  'list' => 
  array (
    'params' => 
    array (
    ),
    'uparams' => 
    array (
      0 => 'user_id',
    ),
    'functions' => 
    array (
      0 => 'file_list',
    ),
    'script_path' => 'modules/lhfile/list.php',
  ),
  'delete' => 
  array (
    'params' => 
    array (
      0 => 'file_id',
    ),
    'uparams' => 
    array (
      0 => 'csfr',
    ),
    'functions' => 
    array (
      0 => 'file_delete',
    ),
    'script_path' => 'modules/lhfile/delete.php',
  ),
  'deletechatfile' => 
  array (
    'params' => 
    array (
      0 => 'file_id',
    ),
    'uparams' => 
    array (
      0 => 'csfr',
    ),
    'functions' => 
    array (
      0 => 'file_delete_chat',
    ),
    'script_path' => 'modules/lhfile/deletechatfile.php',
  ),
  'storescreenshot' => 
  array (
    'params' => 
    array (
    ),
    'uparams' => 
    array (
      0 => 'vid',
      1 => 'hash',
      2 => 'hash_resume',
    ),
    'script_path' => 'modules/lhfile/storescreenshot.php',
  ),
);
?>