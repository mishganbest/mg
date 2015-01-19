<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $text_message; ?>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
  
<?php if(isset($order_id) && $order_id) { ?>
	<script type="text/javascript">
		var yaParams = {
				order_id: "<?php echo $order_id; ?>",
				order_price: <?php echo  round($order_info["total"]); ?>,
				currency: "<?php echo $order_info["currency_code"]; ?>",
				exchange_rate: 1,
				goods: []
		};
	  
		<?php foreach ($order_products as $i=>$row) { ?>
			yaParams.goods[<?php echo $i; ?>] = {
						id: "<?php echo $row["order_product_id"]; ?>",
						name: "<?php echo htmlentities($row['name'].' '.$row['optname'],ENT_COMPAT,'UTF-8'); ?>",
						price: "<?php echo  round($row["price"]); ?>",
						quantity: "<?php echo $row["quantity"]; ?>"
					  }
		<?php } ?>					
	</script>

	<script type="text/javascript">
		
	// Оплата
	_gaq.push(['_addTrans',
		'<?php echo $order_id; ?>',         // номер заказа
		'<?php echo $store_name; ?>',   // название партнера или магазина
		'<?php echo  round($order_info["total"]); ?>',    // итоговая суммарная стоимость заказа
		'',           // налоги
		'',           // стоимость доставки
		'', 	    // город доставки
		'', 	    // регион доставки
		''          // страна доставки
	]);
		
	// Товар (выводить для каждого товара из корзины)
	<?php foreach ($order_products as $i=>$row) { ?>
	<?php if ($row['option_sku']) { ?>
		<?php $sku = $row['option_sku']; ?>
	<?php } else { ?>
		<?php $sku = $row['sku']; ?>
	<?php } ?>
	_gaq.push(['_addItem',
		'<?php echo $order_id; ?>',    // номер заказа
		'<?php echo htmlentities($sku,ENT_COMPAT,'UTF-8'); ?>',   // код товара (или SKU)
		'<?php echo htmlentities($row['name'].' '.$row['optname'],ENT_COMPAT,'UTF-8'); ?>',  // название товара
		'',     // категория или версия
		'<?php echo  round($row["price"]); ?>',          // цена за единицу
		'<?php echo $row["quantity"]; ?>'               // количество единиц товара
	]);
	<?php } ?>	
	// Отправка данных
	_gaq.push(['_trackTrans']);

	</script>
	<?php } ?>
<?php echo $footer; ?>