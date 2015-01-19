<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>" xml:lang="<?php echo $language; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/blank.css" />
<style media='print' type='text/css'>
.noprint {display: none}
body {background:#FFF; color:#000}
</style>
</head>
<body>
<span class="noprint">
<a onClick="window.print()" href="javascript:void(0)"><img src="view/image/print.png" title="Печать товарного чека" /></a>
</span>
<div style="width: 620px" class="block">

  <table class="product">
    <tr class="heading">
      <td><?php echo $column_product_name; ?></td>
      <td style="width: 70px" align="right"><?php echo $column_product_sku; ?></td>
      <td style="width: 70px" align="right"><?php echo $column_product_rate; ?></td>
    </tr>
<?php foreach ($products as $product) { ?>
<?php if ($product['option']) { ?>
	<tr>
		<td style="text-align: left"><?php echo $product['name']; ?></td>
		<td style="border-left: none"></td><td style="border-left: none"></td>
	</tr>

	<?php foreach ($product['option'] as $option) { ?>
	<?php if ($option['rate_stock']) { ?>
	<?php $rate_stock = $option['rate_stock'] - $option['quantity']; ?>
	<?php } else { ?>
	<?php $rate_stock = ''; ?>
	<?php } ?>
	<?php if ($rate_stock > 0) { ?>
	<tr>
	      <td>&nbsp;<small> - <?php echo $option['name']; ?></small></td>
	      <td align="right" class="number"><?php echo $option['option_sku']; ?></td>
	      <td align="right" class="number"><?php echo $rate_stock; ?></td>
	</tr>
	<?php } ?>
	<?php } ?>

<?php } else { ?>
	<?php if ($product['rate_stock']) { ?>
	<?php $rate_stock = $product['rate_stock'] - $product['quantity']; ?>
	<?php } else { ?>
	<?php $rate_stock = ''; ?>
	<?php } ?>
	<?php if ($rate_stock > 0) { ?>
 	<tr>
	      <td style="text-align: left"><?php echo $product['name']; ?></td>
	      <td align="right" class="number"><?php echo $product['sku']; ?></td>
	      <td align="right" class="number"><?php echo $rate_stock; ?></td>
	</tr>
	<?php } ?>
<?php } ?>
<?php } ?>
   
</table>
</div>

</body>
</html>