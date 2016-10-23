<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"?>
<html <?php language_attributes(); ?>>
<head>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" />
<link rel="stylesheet" href=<?php echo get_stylesheet_uri(); ?>>
<?php
wp_enqueue_script("jquery");
add_theme_support( 'automatic-feed-links' );
//add_theme_support( "title-tag" );
if ( ! isset( $content_width ) ) $content_width = 900;
if ( is_singular() ) wp_enqueue_script( "comment-reply" );
wp_head();
?>  
<script>
window.onload = function(){
    var sidebarElement = document.getElementById("sidebar");
    var linkElements = sidebarElement.getElementsByTagName('a');
    var currentPage = window.location.href;
    currentPage = currentPage.substr(0,currentPage.length - 1);
    for(var i=0;i<linkElements.length;i++){
        if(linkElements[i].href === currentPage){
            var parentElement = linkElements[i].parentNode;
            parentElement.className += 'active ';
        }
    }
}
</script>
</head>
<body <?php body_class();?>>
<div class="panel panel-primary">
  <div class="panel-heading text-center">
      <h2 id="page-title">System zarzadzania wolontariuszami</h2>
  </div>
</div>