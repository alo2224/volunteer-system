<div id='sidebar' class="nav nav-pills nav-stacked">
  <li role="presentation"><a href="<?php echo substr(get_permalink(get_user_meta(get_current_user_id(), 'wolontariusz_id', true)), 0 , -1)?>">Twoje dane</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'kalendarz');?>">Kalendarz</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'events');?>">Wydarzenia</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'komunikat');?>">Komunikaty</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'dni-dziedzictwa');?>">Dni Dziedzictwa</a></li>
  <li role="presentation"><a href="<?php echo get_site_url(null , 'dokumenty');?>">Dokumenty</a></li>
  <li role="presentation"><a href="<?php echo wp_logout_url(); ?>">Wyloguj</a></li>
</div>
