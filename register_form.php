<?php
 require_once('bookmark_fns.php');
 do_html_header('User Registration');

 display_registration_form();
 do_html_url('index.php', 'Continue Without Login');


 do_html_footer();
?>