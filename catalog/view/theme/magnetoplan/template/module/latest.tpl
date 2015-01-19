  <?php if ($products) { ?>
<br />
  <div class="product-grid">
    <?php foreach ($products as $product) { ?>
    <div>
      <?php if ($product['thumb']) { ?>
      <div class="image"><a href="<?php echo $product['href']; ?>">
<?php if ($product['special']) { ?>
	<div class="icon_special"></div>
<?php } ?><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
      <?php if ($product['price']) { ?>
      <div class="price">
	<span class="text_price_title">Цена:</span>
        <?php if (!$product['special']) { ?>
	<?php if ($product['minprice']) { ?>
		<span class="text_minmax">от</span> <?php echo $product['minprice']; ?> <span class="text_price">руб/шт.</span><br /><span class="text_minmax">до</span> <?php echo $product['maxprice']; ?> <span class="text_price">руб/шт.</span>
	<?php } else { ?>
        	<?php echo $product['price']; ?> <span class="text_price">руб/шт.</span>
	<?php } ?>
        <?php } else { ?>
<?php if ($product['minprice']) { ?>
		<span class="text_minmax">от</span> <?php echo $product['minprice']; ?> <span class="text_price">руб/шт.</span><br /><span class="text_minmax">до</span> <?php echo $product['maxprice']; ?> <span class="text_price">руб/шт.</span>
	<?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?> <span class="text_price">руб/шт.</span></span><br /> <span class="price-new"><?php echo $product['special']; ?> <span class="text_price">руб/шт.</span></span>
        <?php } ?>
<?php } ?>
      </div>
      <?php } ?>
      <div class="cart">
       <a class="button" href="<?php echo $product['href']; ?>">Подробнее</a><br />
       <a class="call_link" onclick="recall_show('<?php echo $product['name']; ?>');" href="javascript:void(0);"><span>Перезвоните мне</span></a>
      </div>
    </div>
    <?php } ?>
  </div>
<?php } ?>