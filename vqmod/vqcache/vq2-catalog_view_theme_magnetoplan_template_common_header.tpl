<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/magnetoplan/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/magnetoplan/stylesheet/filter.css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/magnetoplan/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/magnetoplan/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php echo $google_analytics; ?>
</head>
<body>
<div id="container">
<div id="header_wrapper">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>

 <div class="info_link">
    <?php if (!$logged) { ?>
    <?php echo $text_welcome; ?> |
    <?php } else { ?>
    <?php echo $text_logged; ?> |
    <?php } ?>
 <?php if (!empty($delivery_href)) { ?>
   <a href="<?php echo $delivery_href; ?>">Доставка и оплата</a> |
   <?php } else { ?>
   <a href="dostavka-po-rossii/">Доставка и оплата</a> |
   <?php } ?>
   <a href="<?php echo $contact_href; ?>">Контакты</a>	
</div>

<div class="info">
 	<span class="time_1">On-line магазин: 9:00 - 21:00  - 7 дней в неделю</span>
	<span class="time_2">Розничный магазин: 11:00 - 19:00 пн - пт</span>
	<span class="address">Новосибирск, ул. Галущака, 2а  <br />оф. 105 (ТОЦ "Олимпия", 1 этаж)</span>
</div>

<div class="contacts"> 
  <?php if (isset($this->session->data['url_detect'])) { ?>
  <span class="phone"><?php echo $this->session->data['url_detect']; ?></span>
  <?php } else { ?>
  <span class="phone">8 (383) 310-33-39</span>
  <?php } ?>
  <br />
  <span class="delivery">Доставка по всей России!</span>
  <br />
  <span class="phone">8 (800) 250-07-33</span>
  
<?php foreach ($modules as $module) { ?> 
<?php echo $module; ?> 
<?php } ?>
	
</div>

<?php echo $cart; ?>
  <div id="search">
    <div class="button-search"></div>
    <?php if ($filter_name) { ?>
    <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
    <?php } else { ?>
    <input type="text" name="filter_name" value="<?php echo $text_search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
    <?php } ?>
  </div>
 
</div>
</div>
<?php if ($categories) { ?>
<div id="menu">
  <ul>
    <?php foreach ($categories as $category) { ?>
    <li><?php if ($category['active']) { ?>
	<a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
	<?php } else { ?>
	<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
	<?php } ?>

      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><img src="<?php echo $category['children'][$i]['image']; ?>" alt="<?php echo $category['children'][$i]['name']; ?>" /><span><?php echo $category['children'][$i]['name']; ?></span></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
<!-- <li><a class="optovik" href="optovikam">Предложение оптовикам</a></li> -->
  </ul>
</div>
<?php } ?>
<div id="wrapper">
<div class="benefits"> 
  <span class="b_info_1">Официальный<br />  дистрибьютор</span>
  <span class="b_info_2">Бесплатная доставка<br />  от 3000 руб</span>
  <span class="b_info_3">Гарантия<br />  на поверхность<br /> 5 лет</span>
  <span class="b_info_4">Немецкое<br /> качество</span>
 </div>

<div id="notification"></div>
