<?php
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  movie_html_header($name);

  // get the book info out from db
  $book_array = get_books($catid);

  display_books($book_array);

  display_button("index.php", "continue-shopping", "Continue Shopping");

  do_html_footer();
?>
