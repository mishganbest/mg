<?php
if (isset($w_categories)) {
	foreach ($w_categories as $w_category) {
?>
<?php if (isset($w_category["products"])) { ?>

<?php if ($w_category["category_id"] == '59' || $w_category["category_id"] == '60') { ?>
<br />
<?php } else { ?>
  <div class="home-heading"><h2><?php echo $w_category["heading_title"]; ?></h2></div>
<?php } ?>
  
 <div class="product-grid">
    <?php foreach ($w_category["products"] as $product) { ?>
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
	<?php if ($product['minprice']) { ?>
       <a class="call_link" onclick="recall_show('<?php echo $product['name']; ?>');" href="javascript:void(0);"><span>Перезвоните мне</span></a>
	<?php } else { ?>
	<a class="button addcart" href="javascript:void(0);" onclick="addToCart('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></a>
	<?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
  
<?php } ?>

<?php
	} // foreach ($w_categories as $w_category) {
} // if (isset($w_categories)) {
?>