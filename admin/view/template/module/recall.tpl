<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
<table class="form">
        <tr>
          <td><?php echo $text_sendsms?></td>
          <td><input type="checkbox" name="sendsms" <?php if ($sendsms) echo "checked='checked'"?>></td>
		</tr>
        <tr>
          <td><?php echo $text_smslength?></td>
          <td><input type="text" name="smslength" value="<?php echo $smslength?>" style="width: 30px;"></td>
		</tr>
	<tr>
		<td><?php echo $text_fields?></td>
		<td><table>
			<tr>
				<th>&nbsp;</th>
				<th><?php echo $text_show?></th>
				<th><?php echo $text_required?></th>
			</tr>
			<tr>
				<td><?php echo $text_name?></td>
				<td><input type="checkbox" name="show_name" <?php if ($show_name)echo "checked='checked'"?>></td>
				<td><input type="checkbox" name="required_name" <?php if ($required_name)echo "checked='checked'"?>></td>
			</tr>
			<tr>
				<td><?php echo $text_email?></td>
				<td><input type="checkbox" name="show_email" <?php if ($show_email)echo "checked='checked'"?>></td>
				<td><input type="checkbox" name="required_email" <?php if ($required_email)echo "checked='checked'"?>></td>
			</tr>
			<tr>
				<td><?php echo $text_time?></td>
				<td><input type="checkbox" name="show_time" <?php if ($show_time)echo "checked='checked'"?>></td>
				<td><input type="checkbox" name="required_time" <?php if ($required_time)echo "checked='checked'"?>></td>
			</tr>
			<tr>
				<td><?php echo $text_comment?></td>
				<td><input type="checkbox" name="show_comment" <?php if ($show_comment)echo "checked='checked'"?>></td>
				<td><input type="checkbox" name="required_comment" <?php if ($required_comment)echo "checked='checked'"?>></td>
			</tr>
			<tr>
				<td><?php echo $text_phone?></td>
				<td><input type="checkbox" checked='checked' disabled></td>
				<td><input type="checkbox" name="required_phone" <?php if ($required_phone)echo "checked='checked'"?>></td>
			</tr>
		</table></td>
	</tr>
</table>

      <table id="module" class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="right"><?php echo $entry_sort_order; ?></td>
            <td></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { ?>
        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
            <td class="left"><select name="recall_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td class="left"><select name="recall_module[<?php echo $module_row; ?>][position]">
                <?php if ($module['position'] == 'content_header') { ?>
                <option value="content_header" selected="selected"><?php echo $text_content_header; ?></option>
                <?php } else { ?>
                <option value="content_header"><?php echo $text_content_header; ?></option>
                <?php } ?>
               
              </select></td>
            <td class="left"><select name="recall_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
            <td class="right"><input type="text" name="recall_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript"><!--

var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="recall_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="recall_module[' + module_row + '][position]">';
	html += '      <option value="content_header"><?php echo $text_content_header; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="recall_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="recall_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}
//--></script>
<?php echo $footer; ?>