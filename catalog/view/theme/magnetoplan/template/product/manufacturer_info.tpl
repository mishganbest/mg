<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($products) { ?>
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
        <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
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
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php if ($description) { ?>
  <div class="manufacturer-info"><?php echo $description; ?></div>
  <?php } ?>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
 
<?php echo $footer; ?>