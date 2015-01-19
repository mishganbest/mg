<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $description; ?>

<?php if ($this->request->get['information_id'] == '7') { ?>

<div id="opt_contact" style="padding-top: 10px">
    <form action="<?php echo $action; ?>" id="contact_form" method="post" enctype="multipart/form-data">
    <table class="order">
	<tr>
	    <td><b><?php echo $entry_lastname; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="lastname" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_firstname; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="firstname" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_patronymic; ?></b></td>
	    <td><input type="text" name="patronymic" value="" /></td>
	</tr>
	<tr>
	     <td><b><?php echo $entry_city; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="city" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_company; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="company" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_website; ?></b></td>
	    <td><input type="text" name="website" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_email; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="email" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_telephone; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="telephone" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_address; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="address" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_inn; ?></b> <span class="required">*</span></td>
	    <td><input type="text" name="inn" value="" /></td>
	</tr>
	<tr>
	    <td><b><?php echo $entry_comment; ?></b></td>
	    <td><textarea name="comment" cols="35" rows="5"></textarea></td>
	</tr>
	<tr>
	    <td></td>
		<td><a id="button_order" class="button" href="javascript:void(0);"><?php echo $button_send; ?></a></td>
	</tr>
    </table>   
  </form>
  </div>

<script type="text/javascript"><!--
$('#button_order').bind('click', function() {
	$.ajax({
		url: 'index.php?route=information/information/validate',
		type: 'post',
		dataType: 'json',
		data: 'lastname=' + encodeURIComponent($('input[name=\'lastname\']').val()) + '&firstname=' + encodeURIComponent($('input[name=\'firstname\']').val()) + '&patronymic=' + $('input[name=\'patronymic\']').val() + '&city=' + $('input[name=\'city\']').val() + '&company=' + encodeURIComponent($('input[name=\'company\']').val()) + '&website=' + encodeURIComponent($('input[name=\'website\']').val()) + '&email=' + $('input[name=\'email\']').val() + '&telephone=' + encodeURIComponent($('input[name=\'telephone\']').val()) + '&address=' + $('input[name=\'address\']').val() + '&inn=' + $('input[name=\'inn\']').val() + '&comment=' + $('textarea[name=\'comment\']').val(),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button_order').attr('disabled', true);
			$('#opt_contact').before('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button_order').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#opt_contact').before('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#opt_contact').before('<div class="success">' + data['success'] + '</div>');
					
				$('input[name=\'lastname\']').val('');			
				$('input[name=\'firstname\']').val('');
				$('input[name=\'patronymic\']').val('');
				$('input[name=\'city\']').val('');
				$('input[name=\'company\']').val('');
				$('input[name=\'website\']').val('');
				$('input[name=\'email\']').val('');
				$('input[name=\'telephone\']').val('');
				$('input[name=\'address\']').val('');
				$('input[name=\'inn\']').val('');
				$('textarea[name=\'comment\']').val('');
			}
		}
	});
});
//--></script>

<?php } else { ?>

  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>

<?php } ?>

 <?php echo $content_bottom; ?></div> 

<?php echo $footer; ?>