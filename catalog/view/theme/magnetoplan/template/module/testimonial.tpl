<!--noindex-->
<div class="box">
  <div class="box-heading">
  <?php if ($testimonial_title) { ?> 
  <?php echo $testimonial_title; ?>
  <?php } ?>
  </div>
  <div class="box-content">
    <div class="box-product testimonial_module">

    <table cellpadding="2" cellspacing="0" style="width: 100%">
      <?php foreach ($testimonials as $testimonial) { ?>
      <tr><td>

          <div class="name">

		<?php if ($testimonial['name'] && $testimonial['city']) { ?> 
			<?php echo $testimonial['name']; ?>, 
		<?php } else { ?>	
			<?php echo $testimonial['name']; ?>
		<?php } ?>
		
		<?php if ($testimonial['city']) { ?> 
			г. <?php echo $testimonial['city']; ?>
		<?php } ?>

	</div>
                   
           <div class="thumb">
          
          <?php if ($testimonial['video']) { ?>
          <a rel="nofollow" class="iframe" href="http://www.youtube.com/embed/<?php echo $testimonial['video']; ?>?autoplay=1;rel=0"><span class="video"></span></a>
      <a rel="nofollow" class="iframe" href="http://www.youtube.com/embed/<?php echo $testimonial['video']; ?>?autoplay=1;rel=0"><img style="width: 80px" src="http://img.youtube.com/vi/<?php echo $testimonial['video']; ?>/default.jpg" alt="" /></a>
      	  <?php } elseif ($testimonial['image']) { ?>          
          <a rel="nofollow" href="<?php echo $testimonial['image']; ?>" class="colorbox"><img src="<?php echo $testimonial['thumb']; ?>" alt="" /></a>
          <?php } ?>
          
          </div>
                   
          <div><?php echo $testimonial['description']; ?></div>

          <div class="bottom">

	<?php if ($testimonial['audio']) { ?> 
      <div class="audio">
 <script type="text/javascript" src="catalog/view/javascript/audio/audio-player.js"></script>
<object type="application/x-shockwave-flash" data="catalog/view/javascript/audio/player.swf" id="audioplayer<?php echo $testimonial['id']; ?>" height="20" width="190">
<param name="movie" value="catalog/view/javascript/audio/player.swf">
<param name="FlashVars" value="playerID=<?php echo $testimonial['id']; ?>&amp;soundFile=<?php echo $testimonial['audio']; ?>">
<param name="quality" value="high">
<param name="menu" value="false">
<param name="wmode" value="transparent"></object>
      </div>
     <?php } ?>

<div class="date_added"><?php echo $testimonial['date_added']; ?></div>

	</div>
     </td>
 </tr>

      <?php } ?>
</table>

	<span class="bottom_links"><a rel="nofollow" href="<?php echo $showall_url; ?>"><?php echo $show_all; ?></a> &emsp; <a rel="nofollow" href="<?php echo $isitesti; ?>"><?php echo $isi_testimonial; ?></a></span>

    </div>
  </div>   
</div>
<!--/noindex-->
<script type="text/javascript"><!--
$('.iframe').colorbox({iframe:true, innerWidth:640, innerHeight:390});
//--></script>
