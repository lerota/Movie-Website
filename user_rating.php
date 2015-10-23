<?php
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $new_rating = $_POST['movie_rating'];
  $movie_id = $_POST['movie_id'];


  // get this book out of database
  $book = get_book_details($movie_id);
  movie_html_header($book[0]['title']);
  display_movie_movie_id($book);

  // set url for "continue button"
  $target = "index.php";
  //if($book[0]['movie_id']) {
  //  $target = "show_cat.php?isbn=".$book[0]['movie_id'];
  //}
  add_rating_to_db($movie_id,$new_rating);
  echo"Rated successfully.";
  echo"<hr />";
  display_button("show_cart.php?new=".$movie_id, "add-to-cart",
                   "Add".$book[0]['title']." To My Shopping Cart");
  display_button($target, "continue-shopping", "Continue Shopping");

  do_html_footer();
?>