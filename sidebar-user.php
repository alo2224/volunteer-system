<div class="nav nav-pills nav-stacked">
  <li role="presentation"><a href="<?php echo get_permalink(get_wolontariusz_id(get_current_user_id()))?>">Twoje dane</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'kalendarz');?>">Kalendarz</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'komunikat');?>">Komunikaty</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'dni-dziedzictwa');?>">Dni Dziedzictwa</a></li>
  <li role="presentation"><a href="<?php echo wp_logout_url(); ?>">Wyloguj</a></li>
</div>
