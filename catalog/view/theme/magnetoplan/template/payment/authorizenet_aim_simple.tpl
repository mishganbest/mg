<form id="payment">
    <input type="hidden" name="cc_owner" value="<?php echo $cc_owner ?>">
    <input type="hidden" name="cc_number" value="<?php echo $cc_number ?>">
    <input type="hidden" name="cc_expire_date_month" value="<?php echo $cc_expire_date_month ?>">
    <input type="hidden" name="cc_expire_date_year" value="<?php echo $cc_expire_date_year ?>">
    <input type="hidden" name="cc_cvv2" value="<?php echo $cc_cvv2 ?>">
</form>
<div class="buttons">
  <div class="right"><input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" /></div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
    $.ajax({
        url: 'index.php?route=payment/authorizenet_aim_simple/send',
        type: 'post',
        data: $('#payment :input'),
        dataType: 'json',        
        beforeSend: function() {
            $('#simplecheckout_proceed_payment').prepend('<img id="proceed_loading" src="catalog/view/theme/default/image/loading.gif">&nbsp;');
            $('#authorizenet_aim_simple_inputs input,#authorizenet_aim_simple_inputs select').attr('disabled', 'disabled');
        },
        complete: function() {
            $('#simplecheckout_proceed_payment').hide();
            $('#authorizenet_aim_simple_inputs input,#authorizenet_aim_simple_inputs select').removeAttr('disabled');
            $('#proceed_loading').remove();
        },                
        success: function(json) {
            if (json['error']) {
                alert(json['error']);
            }
            
            if (json['success']) {
                location = json['success'];
            }
        }
    });
});
//--></script>