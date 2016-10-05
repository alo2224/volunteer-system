<?php
if(current_user_can('delete_posts')){
    get_sidebar('admin');
}
else{
    get_sidebar('user');
}
?>

