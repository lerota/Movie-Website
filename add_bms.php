<?php
 require_once('bookmark_fns.php');
 session_start();

  //create short variable name
  $new_movie_id = $_POST['new_movie_id'];

  do_html_header('Adding Watched Movies');

  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('Form not completely filled out.');
    }

    // try to add bm
    add_bm($new_movie_id);
    echo 'Movie added.';

    // get the bookmarks this user has saved
    if ($url_array = get_user_urls($_SESSION['valid_user'])) {
      display_user_urls($url_array);
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
