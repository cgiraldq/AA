<!DOCTYPE html><html lang="es" dir="ltr"><head><?php  if (isset($Result['fullheight']) && $Result['fullheight']) : ?><style>html, body {height: 100% !important;}</style><?php   endif; ?><title><?php  if (isset($Result['path'])) : ?><?php $ReverseOrder = $Result['path']; krsort($ReverseOrder); foreach ($ReverseOrder as $pathItem) : ?><?php  echo htmlspecialchars($pathItem['title']).' '?>&laquo;<?php  echo ' ';endforeach;?><?php  endif; ?><?php  echo htmlspecialchars('')?></title><meta http-equiv="content-type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"><link rel="shortcut icon" type="image/x-icon" href="/chat/lhc_web/design/defaulttheme/images/favicon.ico"><link rel="icon" type="image/png" href="/chat/lhc_web/design/defaulttheme/images/favicon.ico" /><meta name="Keywords" content="" /><meta name="Description" content="" /><meta name="robots" content="noindex, nofollow"><meta name="copyright" content="Remigijus Kiminas, livehelperchat.com"><?php  if ('ltr' == 'ltr' || 'ltr' == '') : ?><link rel="stylesheet" type="text/css" href="/chat/lhc_web/cache/compiledtemplates/29118874c1200e124024214d6748ad23.css" /><?php  else : ?><link rel="stylesheet" type="text/css" href="/chat/lhc_web/cache/compiledtemplates/0997e60b65251a0a7221e9846834fe07.css" /><?php  endif;?><?php  echo isset($Result['additional_header_css']) ? $Result['additional_header_css'] : ''?><?php  if (isset($Result['theme']) && $Result['theme'] !== false) : ?><style><?php  if ($Result['theme']->buble_visitor_background != '') : ?>div.message-row.response{background-color:#<?php  echo htmlspecialchars($Result['theme']->buble_visitor_background)?>;}<?php  endif;?><?php  if ($Result['theme']->buble_visitor_text_color != '') : ?>div.message-row.response{color:#<?php  echo htmlspecialchars($Result['theme']->buble_visitor_text_color)?>;}<?php  endif;?><?php  if ($Result['theme']->buble_visitor_title_color != '') : ?>.vis-tit{color:#<?php  echo htmlspecialchars($Result['theme']->buble_visitor_title_color)?>;}<?php  endif;?><?php  if ($Result['theme']->buble_operator_background != '') : ?>div.message-admin{background-color:#<?php  echo htmlspecialchars($Result['theme']->buble_operator_background)?>;}<?php  endif;?><?php  if ($Result['theme']->buble_operator_text_color != '') : ?>div.message-admin{color:#<?php  echo htmlspecialchars($Result['theme']->buble_operator_text_color)?>;}<?php  endif;?><?php  if ($Result['theme']->buble_operator_title_color != '') : ?>.op-tit{color:#<?php  echo htmlspecialchars($Result['theme']->buble_operator_title_color)?>;}<?php  endif;?></style><?php  endif;?><?php   ?><script type="text/javascript">var WWW_DIR_JAVASCRIPT = '/chat/lhc_web/index.php/esp/';var WWW_DIR_JAVASCRIPT_FILES = '/chat/lhc_web/design/defaulttheme/sound';var WWW_DIR_LHC_WEBPACK = '/chat/lhc_web/design/defaulttheme/js/lh/dist/';var WWW_DIR_JAVASCRIPT_FILES_NOTIFICATION = '/chat/lhc_web/design/defaulttheme/images/notification';var confLH = {};<?php  $soundData = array (0 => false,'repeat_sound' => 1,'repeat_sound_delay' => 5,'show_alert' => false,'new_chat_sound_enabled' => true,'new_message_sound_admin_enabled' => true,'new_message_sound_user_enabled' => true,'online_timeout' => 300,'check_for_operator_msg' => 10,'back_office_sinterval' => 10,'chat_message_sinterval' => 3.5,'long_polling_enabled' => false,'polling_chat_message_sinterval' => 1.5,'polling_back_office_sinterval' => 5,'connection_timeout' => 30,'browser_notification_message' => false,); ?>confLH.back_office_sinterval = <?php  echo (int)($soundData['back_office_sinterval']*1000) ?>;confLH.chat_message_sinterval = <?php  echo (int)($soundData['chat_message_sinterval']*1000) ?>;confLH.new_chat_sound_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('new_chat_sound',(int)($soundData['new_chat_sound_enabled'])) ?>;confLH.new_message_sound_admin_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_admin_enabled'])) ?>;confLH.new_message_sound_user_enabled = <?php  echo (int)erLhcoreClassModelUserSetting::getSetting('chat_message',(int)($soundData['new_message_sound_user_enabled'])) ?>;confLH.new_message_browser_notification = <?php  echo isset($soundData['browser_notification_message']) ? (int)($soundData['browser_notification_message']) : 0 ?>;confLH.transLation = {'new_chat':'Nueva solicitud de chat'};confLH.csrf_token = '<?php  echo erLhcoreClassUser::instance()->getCSFRToken()?>';confLH.repeat_sound = <?php  echo (int)$soundData['repeat_sound']?>;confLH.repeat_sound_delay = <?php  echo (int)$soundData['repeat_sound_delay']?>;confLH.show_alert = <?php  echo (int)$soundData['show_alert']?>;</script><script type="text/javascript" src="/chat/lhc_web/cache/compiledtemplates/e7b4d3149ffbdf282ed4c4380e399cfd.js"></script><?php  echo isset($Result['additional_header_js']) ? $Result['additional_header_js'] : ''?><?php   ?><link rel="stylesheet" type="text/css" href="/chat/lhc_web/cache/compiledtemplates/6daf719db0d043d3099dc05457129d88.css" /><?php  if (isset($Result['theme']) && $Result['theme']->custom_widget_css != '') : ?><style type="text/css"><?php  echo $Result['theme']->custom_widget_css?></style><?php  endif;?></head><body<?php  isset($Result['pagelayout_css_append']) ? print ' class="'.$Result['pagelayout_css_append'].'" ' : ''?>><div id="widget-layout" class="row"><div class="col-xs-12"><?php  echo $Result['content']; ?></div></div><div id="widget-layout-js"><?php  if (isset($Result['dynamic_height'])) : ?><script>var wasFocused = false;lhinst.isWidgetMode = true;$('input[type="text"]').first().click(function(){if (wasFocused == false){wasFocused=true;$(this).select().focus();}});$('textarea').first().click(function(){if (wasFocused == false){wasFocused=true;$(this).select();}});if (!!window.postMessage) {<?php  if (!isset($Result['fullheight']) || (isset($Result['fullheight']) && !$Result['fullheight'])) : ?>var heightContent = 0;var heightElement = $('#widget-layout');setInterval(function(){var currentHeight = heightElement.height();if (heightContent != currentHeight){heightContent = currentHeight;try {parent.postMessage('<?php  echo $Result['dynamic_height_message']?>:'+(parseInt(heightContent)+<?php  (isset($Result['dynamic_height_append'])) ? print $Result['dynamic_height_append'] : print 15?>), '*');} catch(e) {};};},200);<?php  endif; ?><?php  if (isset($Result['chat']) && is_numeric($Result['chat']->id)) : ?>parent.postMessage("lhc_ch:hash:<?php  echo $Result['chat']->id,'_',$Result['chat']->hash?>", '*');parent.postMessage("lhc_ch:hash_resume:<?php  echo $Result['chat']->id,'_',$Result['chat']->hash?>", '*');<?php  endif; ?><?php  if (isset($Result['additional_post_message'])) : ?>parent.postMessage("<?php  echo $Result['additional_post_message']?>", '*');<?php  endif;?><?php  if (isset($Result['parent_messages'])) : foreach ($Result['parent_messages'] as $msgPArent) : ?>parent.postMessage("<?php  echo $msgPArent?>", '*');<?php  endforeach;endif;?>};</script><?php  endif;?><?php  if (false == true) { $debug = ezcDebug::getInstance(); echo $debug->generateOutput(); } ?></div></body></html>