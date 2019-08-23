<?php   $modalHeaderClass = 'small-modal-header'; $modalHeaderTitle = 'Your information'; $modalSize = 'md'; ?><div class="modal-dialog modal-<?php  isset($modalSize) ? print $modalSize : print 'lg'?>"><div class="modal-content"><div class="modal-header<?php  (isset($modalHeaderClass)) ? print ' '.$modalHeaderClass : ''?>"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel"><span class="material-icons">info_outline</span><?php  isset($modalHeaderTitle) ? print $modalHeaderTitle : ''?></h4></div><div class="modal-body<?php  (isset($modalBodyClass)) ? print ' '.$modalBodyClass : ''?>"><?php  if (isset($errors)) : ?><?php  if (isset($errors)) : ?><div data-alert class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul class="validation-ul"><?php  foreach ($errors as $err) : ?><li><?php  echo $err?></li><?php  endforeach;?></ul></div><?php  endif;?><?php  endif; ?><?php  if (isset($updated) && $updated == true) : $msg = 'Updated!'; ?><script>$('#messages .usr-tit.vis-tit').text(<?php  echo json_encode($chat->nick)?>).prepend('<i class="material-icons chat-operators mi-fs15 mr-0">face</i>');setTimeout(function(){$('#myModal').modal('hide');},100);</script><div role="alert" class="alert alert-success alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php  echo $msg?></div><?php  else : ?><form action="/chat/lhc_web/index.php/esp/chat/editnick/<?php  echo $chat->id,'/',$chat->hash?>" method="post" onsubmit="return lhinst.submitModalForm($(this))"><div class="form-group"><label class="control-label">Nombre</label><input maxlength="50" type="text" name="UserNick" class="form-control input-sm" value="<?php  echo htmlspecialchars($chat->nick)?>" /></div><div class="row form-group"><div class="col-xs-6 pr5"><label class="control-label">E-mail</label><input type="text" name="Email" class="form-control input-sm" value="<?php  echo htmlspecialchars($chat->email)?>" /></div><div class="col-xs-6 pl5"><label class="control-label">Teléfono</label><input type="text" maxlength="50" name="UserPhone" class="form-control input-sm" value="<?php  echo htmlspecialchars($chat->phone)?>" /></div></div><div class="btn-group" role="group" aria-label="..."><input type="submit" value="Guardar" class="btn btn-default btn-sm"><input type="button" value="Cancelar" class="btn btn-default btn-sm" onclick="$('#myModal').modal('hide')"></div></form><?php  endif; ?></div></div></div>