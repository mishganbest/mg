<div class="additionally">

<h3>C этим товаром берут</h3>

<?php if (isset($w_categories)) { ?>
<?php foreach ($w_categories as $w_category) { ?>

<div class="cat_block"><h4><?php echo $w_category['heading_title']; ?></h4><a href="<?php echo $w_category['href']; ?>"><img src="<?php echo $w_category['thumb']; ?>" /></a><br />
<a class="button" href="<?php echo $w_category['href']; ?>">Подробнее</a></div>

<?php } ?>
<?php } ?>
</div>