<div id="recall_form" class="ui-draggable" style="border-radius: 10px 10px 10px 10px; display: none;">

	<table cellpadding="0" border="0" class="recall_header " colspan="0" style="border-radius: 5px 5px 5px 5px;">
		<tbody><tr>
			<td valign="center" align="center">
				<div class="green_big_title"><?php echo $text_recall?>
			
				<a style="float: right; padding: 5px 10px 0 0" onclick="recall_close();" class="recall_close" href="javascript:void(0);"><img title="<?php echo $close_window?>" src="catalog/view/theme/magnetoplan/image/cancel.png"></a></div>
			</td>
		</tr>
	</tbody></table>

	<div id="recall_message2" style="display:none;" class="warning error_block">
		<span id="recall_message" class="error_message" style="text-align:center"></span>
	</div>

	<div style="display:none;" id="recall_success" class="success success_block">
			<?php echo $text_success?>
	</div>

	<form id="recall_ajax_form" onsubmit="return recall_ajax();" method="POST">
		<input type="hidden" value="yes" name="recall">
		<table cellspacing="5" class="form_table_recall">
			<tbody>
				<?php if ($show_name) { ?>
			<tr>
				<td class="td_recall_caption"><?php echo $text_name?><?php if( $required_name ) {?>&nbsp;<span class="required">*</span><?php } ?></td>
				<td colspan="2"><input type="text" class="recall_input" value="" id="user_name" name="user_name"><div id="user_name_error" class="error_message"></div></td>
			</tr>
				<?php } ?>
			<tr>
				<td class="td_recall_caption"><?php echo $text_phone?><?php if( $required_phone ) {?>&nbsp;<span class="required">*</span><?php } ?></td>
				<td colspan="2"><input type="text" class="recall_input" value="" id="user_phone" name="user_phone"><div id="user_phone_error" class="error_message"></div></td>
			</tr>
			<?php if ($show_email) { ?>
			<tr>
				<td class="td_recall_caption"><?php echo $text_email?><?php if( $required_email ) {?>&nbsp;<span class="required">*</span><?php } ?></td>
				<td colspan="2"><input type="text" class="recall_input" value="" id="user_email" name="user_email"><div id="user_email_error" class="error_message"></div></td>
			</tr>
				<?php } ?>
			<?php if ($show_time) { ?>
			<tr>
				<td class="td_recall_caption"><?php echo $text_time?><?php if( $required_time ) {?>&nbsp;<span class="required">*</span><?php } ?></td>
				<td colspan="2"><input type="text" class="recall_input" value="" id="recommend_to_call" name="recommend_to_call"><div id="recommend_to_call_error" class="error_message"></div></td>
			</tr>
				<?php } ?>
			
			<tr class="show_product">
				<td class="td_recall_caption"><?php echo $text_product_name?></td>
				<td colspan="2"><input type="text" class="recall_input" value="" id="product" name="product" readonly /></td>
			</tr>
				
			<?php if ($show_comment) { ?>
			<tr>
				<td class="td_recall_caption"><?php echo $text_comment?><?php if( $required_comment ) {?>&nbsp;<span class="required">*</span><?php } ?></td>
				<td colspan="2"><textarea class="recall_input" rows="5" cols="20" id="user_comment" name="user_comment"></textarea><div id="user_comment_error" class="error_message"></div></td>
			</tr>
				<?php } ?>
			<tr><td></td>
			<td>
				<img style="display:none;" id="load_recall" src="catalog/view/theme/magnetoplan/image/loading.gif">
				<input id="submit_recall" class="btn" type="submit" value="<?php echo $text_request?>" />
			</td>
		</tr>
		</tbody></table>
	</form>
</div>
<script>
	function recall_close(){
		$('#recall_form').hide();
		return false;
	}

	function recall_show(product_name){
        margin_top = -$('#recall_form').height()/2;
        margin_left= -$('#recall_form').width()/2;
        $('#recall_form').css({'margin-left': margin_left, 'margin-top': margin_top });
		$('#recall_form').show();

		$('#recall_ajax_form').show();
		$('#recall_success').hide();

		$('#user_name').val('');
		$('#user_phone').val('');
		$('#product').val('');
		$('#recommend_to_call').val('');
		$('#user_comment').val('');
		$('#recall_code').val('');
		$('input[name=\'product\']').val(product_name);
		if (!product_name) {
			$('.show_product').hide();
		}else{
			$('.show_product').show();
		}
		return false;
	}

	function show_message_recall(id_message, message){
		$('.warning').html(message).show();
		$("#"+id_message).focus();
		$("#"+id_message).addClass('input_error');
		return false;
	}

	function recall_ajax(){
		var vars = $('#recall_ajax_form').serialize();
		$('#load_recall').show();
		$('#submit_recall').hide();
		$.ajax({
			type: "POST",
			data: 'recall=yes&'+vars,
			url:'index.php?route=module/recall/ajax',
			dataType:'json',
			success: function(json){
				$('#load_recall').hide();
				$('#submit_recall').show();
				$('.recall_input').removeClass('input_error');
				$('.error_message').html('').hide();
				switch (json['result']) {
					case 'success':
						$('#recall_message2').hide();
						$('#recall_ajax_form').hide();
						$('#recall_success').show();
						yaCounter20960134.reachGoal('CALL');
		    				return true;
					break;
					case 'error':
					    $.each(json['errors'], 
						function(index, value){
							show_message_recall(index, value);
						});

					break;
				}
			}
			});
		return false;
	}
</script>
