<?php if (count($custom)) { ?>
<h2>Simple Data</h2>
<table class="form">
<?php foreach ($custom as $key => $value) { ?>
  <tr>
    <td><?php echo $value['label']; ?></td>
    <td><?php echo $value['text']; ?></td>
  </tr>
<?php } ?>
</table>
<?php } ?>